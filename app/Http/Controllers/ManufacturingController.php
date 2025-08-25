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


class ManufacturingController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'MANUFACTURING') {
            return redirect()->route('home');
        }
        return view('manufacturing.index');
    }

    public function getManufacturingData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'MANUFACTURING') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $manufacturing = Order::whereHas('manufacturingOrderProducts')
                ->where('status', 'ACTIVE')
                ->select(['id', 'created_at', 'orderNumber', 'customerCode', 'productDetails', 'productDescription', 'orderDate', 'dueDate', 'personnelCode', 'personnelName', 'companyName', 'description', 'orderStatus', 'shippingDate', 'note', 'status'])
                ->get();
        }

        return DataTables::of($manufacturing)
            ->editColumn('created_at', function ($manufacturing) {
                return $manufacturing->created_at->format('Y-m-d H:i');
            })
            ->editColumn('orderStatus', function ($manufacturing) {
                switch ($manufacturing->orderStatus) {
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
            ->editColumn('productDetails', function ($manufacturing) {
                $total = 0;
                foreach (json_decode($manufacturing->productDetails) as $product) {
                    $total += $product->quantity;
                }
                return $total;
            })
            ->editColumn('status', function ($manufacturing) {
                return $manufacturing->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
            })
            ->addColumn('actions', function ($manufacturing) {
                return '<a href="' . route('getOrder', ['id' => $manufacturing->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

}