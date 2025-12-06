<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER') {
            return redirect()->route('home');
        }
        return view('reporting.index');
    }

    public function getReportingData(Request $request)
    {
        if ($request->ajax()) {
            $query = OrderProduct::query()
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->join('orders', 'order_product.order_id', '=', 'orders.id')
                ->select(
                    'products.id as product_id',
                    'products.code as product_code',
                    'products.description as product_description',
                    'products.specialCode as special_code',
                    'products.type as product_type',
                    'products.mainUnit as main_unit',
                    DB::raw('SUM(order_product.quantity) as total_quantity'),
                    DB::raw('COUNT(DISTINCT order_product.order_id) as order_count')
                );

            // Tarih filtreleme
            if ($request->has('filterDateFrom') && $request->filterDateFrom != '') {
                $query->where('orders.orderDate', '>=', $request->filterDateFrom);
            }

            if ($request->has('filterDateTo') && $request->filterDateTo != '') {
                $query->where('orders.orderDate', '<=', $request->filterDateTo);
            }

            $query->groupBy('products.id', 'products.code', 'products.description', 'products.specialCode', 'products.type', 'products.mainUnit');

            return DataTables::eloquent($query)
                ->filterColumn('product_code', function($query, $keyword) {
                    $query->whereRaw("products.code like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('product_description', function($query, $keyword) {
                    $query->whereRaw("products.description like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('special_code', function($query, $keyword) {
                    $query->whereRaw("products.specialCode like ?", ["%{$keyword}%"]);
                })
                ->filterColumn('product_type', function($query, $keyword) {
                    $query->whereRaw("products.type like ?", ["%{$keyword}%"]);
                })
                ->editColumn('product_code', function ($row) {
                    return $row->product_code ?? '-';
                })
                ->editColumn('product_description', function ($row) {
                    return $row->product_description ?? '-';
                })
                ->editColumn('special_code', function ($row) {
                    return $row->special_code ?? '-';
                })
                ->editColumn('product_type', function ($row) {
                    return $row->product_type ?? '-';
                })
                ->editColumn('main_unit', function ($row) {
                    return $row->main_unit ?? '-';
                })
                ->editColumn('total_quantity', function ($row) {
                    $formatted = number_format($row->total_quantity, 2, ',', '.');
                    return '<span class="badge badge-success" style="font-size: 14px; padding: 8px 12px;">' . $formatted . '</span>';
                })
                ->editColumn('order_count', function ($row) {
                    return number_format($row->order_count, 0, ',', '.');
                })
                ->rawColumns(['total_quantity'])
                ->make(true);
        }
    }
}
