<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\HttpClient;
use Yajra\DataTables\Facades\DataTables;


class ShippingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'CARGO') {
            return redirect()->route('home');
        }
        return view('shipping.index');
    }

    public function getShippingData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'CARGO') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $shipping = Order::whereHas('shippingOrderProducts')
                ->where('status', 'ACTIVE')
                ->select(['id', 'created_at', 'orderNumber', 'customerCode', 'productDetails', 'productDescription', 'orderDate', 'dueDate', 'personnelCode', 'personnelName', 'companyName', 'description', 'orderStatus', 'shippingDate', 'note', 'status'])
                ->get();
        }

        return DataTables::of($shipping)
            ->editColumn('created_at', function ($shipping) {
                return $shipping->created_at->format('Y-m-d H:i');
            })
            ->editColumn('orderStatus', function ($shipping) {
                switch ($shipping->orderStatus) {
                    case 'SHIPPED':
                        return 'SEVK EDİLDİ';
                    case 'CANCELLED':
                        return 'İPTAL EDİLDİ';
                    case 'IN_PROGRESS':
                        return 'İŞLEMDE';
                    case 'COMPLETED':
                        return 'TAMAMLANDI';
                    case 'APPROVED':
                        return 'ONAYLANDI';
                    default:
                        return 'ONAYLANDI';
                }
            })
            ->editColumn('productDetails', function ($shipping) {
                $total = 0;
                foreach (json_decode($shipping->productDetails) as $product) {
                    $total += $product->quantity;
                }
                return $total;
            })
            ->editColumn('status', function ($shipping) {
                return $shipping->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
            })
            ->addColumn('actions', function ($shipping) {
                return '<a href="' . route('getOrder', ['id' => $shipping->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

}