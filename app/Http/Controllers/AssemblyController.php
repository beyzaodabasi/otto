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


class AssemblyController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'ASSEMBLY') {
            return redirect()->route('home');
        }
        return view('assembly.index');
    }

    public function getAssemblyData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'ASSEMBLY') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $assembly = Order::whereHas('assemblyOrderProducts')
                ->where('status', 'ACTIVE')
                ->select(['id', 'created_at', 'orderNumber', 'customerCode', 'productDetails', 'productDescription', 'orderDate', 'dueDate', 'personnelCode', 'personnelName', 'companyName', 'description', 'orderStatus', 'shippingDate', 'note', 'status'])
                ->get();
        }

        return DataTables::of($assembly)
            ->editColumn('created_at', function ($assembly) {
                return $assembly->created_at->format('Y-m-d H:i');
            })
            ->editColumn('orderStatus', function ($assembly) {
                switch ($assembly->orderStatus) {
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
            ->editColumn('productDetails', function ($assembly) {
                $total = 0;
                foreach (json_decode($assembly->productDetails) as $product) {
                    $total += $product->quantity;
                }
                return $total;
            })
            ->editColumn('status', function ($assembly) {
                return $assembly->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
            })
            ->addColumn('actions', function ($assembly) {
                return '<a href="' . route('getOrder', ['id' => $assembly->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

}