<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\HttpClient;
use Yajra\DataTables\Facades\DataTables;


class OrderController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $orders = Order::with('products')
            ->select([
                'id',
                'created_at',
                'orderNumber',
                'customerCode',
                'productDetails',
                'productDescription',
                'orderDate',
                'dueDate',
                'personnelCode',
                'personnelName',
                'companyName',
                'description',
                'orderStatus',
                'shippingDate',
                'note',
                'status'
            ])
            ->get();
        return view('order.index');
    }

    public function getOrdersData(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::select(['id', 'created_at', 'orderNumber', 'customerCode', 'productDetails', 'productDescription', 'orderDate', 'dueDate', 'personnelCode', 'personnelName', 'companyName', 'description', 'orderStatus', 'shippingDate', 'note', 'status'])
                ->whereNotIn('orderStatus', ['CANCELLED', 'COMPLETED']); // İPTAL EDİLDİ ve TAMAMLANDI hariç
        }

        return DataTables::of($orders)
            ->editColumn('created_at', function ($order) {
                return $order->created_at->format('Y-m-d H:i');
            })
            ->editColumn('orderStatus', function ($order) {
                switch ($order->orderStatus) {
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
            ->editColumn('productDetails', function ($order) {
                $total = 0;
                foreach (json_decode($order->productDetails) as $product) {
                    $total += $product->quantity;
                }
                return $total;
            })
            ->editColumn('status', function ($order) {
                return $order->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
            })
            ->addColumn('actions', function ($order) {
                return '<a href="' . route('getOrder', ['id' => $order->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    // Filtrelenmiş data (filterOrderStatus, filterDateFrom ve filterDateTo gelebilir)
    public function getFilteredOrdersData(Request $request)
    {
        if (! $request->ajax()) {
            abort(400);
        }

        $query = Order::select([
            'id',
            'created_at',
            'orderNumber',
            'customerCode',
            'productDetails',
            'productDescription',
            'orderDate',
            'dueDate',
            'personnelCode',
            'personnelName',
            'companyName',
            'description',
            'orderStatus',
            'shippingDate',
            'note',
            'status'
        ]);

        // Eğer frontend filtre gönderdiyse kullan (dizi olarak gelir)
        if ($request->has('filterOrderStatus') && !empty($request->filterOrderStatus)) {
            // filterOrderStatus array ise direkt whereIn, değilse comma string ise explode et
            $statuses = $request->filterOrderStatus;
            if (!is_array($statuses)) {
                $statuses = explode(',', $statuses);
            }
            $query->whereIn('orderStatus', $statuses);
        }

        // Tarih filtreleri
        if ($request->filled('filterDateFrom')) {
            $query->whereDate('orderDate', '>=', $request->filterDateFrom);
        }
        if ($request->filled('filterDateTo')) {
            $query->whereDate('orderDate', '<=', $request->filterDateTo);
        }

        return DataTables::of($query)
            ->editColumn('created_at', fn($order) => $order->created_at->format('Y-m-d H:i'))

            ->editColumn('productDetails', function ($order) {
                $total = 0;
                foreach (json_decode($order->productDetails) as $product) {
                    $total += $product->quantity;
                }
                return number_format($total, 2, ',', '.');
            })
            ->editColumn('status', fn($order) => $order->status == 'ACTIVE' ? 'Aktif' : 'Pasif')
            ->addColumn('actions', fn($order) => '<a href="' . route('getOrder', ['id' => $order->id]) . '" class="btn btn-primary btn-sm">Detay</a>')
            ->rawColumns(['actions'])
            ->make(true);
    }


    public function getOrder(Request $request)
    {
        // $order = Order::with('products')->find($request->id);
        // return view('order.updateOrder', compact('order'));

        $order = Order::with([
            'products' => function ($query) {
                if (Auth::user()->unit == 'ACCOUNTING') {
                    $query->wherePivot('status', 'ACCOUNTING');
                } elseif (Auth::user()->unit == 'MANUFACTURING') {
                    $query->wherePivot('status', 'MANUFACTURING');
                } elseif (Auth::user()->unit == 'ASSEMBLY') {
                    $query->wherePivot('status', 'ASSEMBLY');
                } elseif (Auth::user()->unit == 'CARGO') {
                    $query->wherePivot('status', 'SHIPPING');
                }
            }
        ])->find($request->id);
        return view('order.updateOrder', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $order = Order::find($id);
        $order->customerCode = $request->customerCode;
        $order->productDescription = $request->productDescription;
        $order->orderDate = $request->orderDate;
        $order->dueDate = $request->dueDate;
        $order->personnelCode = $request->personnelCode;
        $order->personnelName = $request->personnelName;
        $order->companyName = $request->companyName;
        $order->description = $request->description;
        $order->orderStatus = $request->orderStatus;
        $order->shippingDate = $request->shippingDate;
        $order->note = $request->note;
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders')->with('message', 'Sipariş başarıyla güncellendi');
    }

    public function getProductsData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $products = Product::select(['id', 'specialCodeDescription', 'type', 'code', 'description', 'groupCode', 'mainUnit']);
            return DataTables::of($products)->make(true);
        }
    }

    public function newOrder(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $orderNumber = Order::orderBy('orderNumber', 'desc')->first();
        $orderNumber = $orderNumber ? $orderNumber->orderNumber : 'SS00000';
        $orderNumber = 'SS' . str_pad((int) substr($orderNumber, 2) + 1, 5, '0', STR_PAD_LEFT);

        return view('order.newOrder', compact('orderNumber'));
    }

    public function createOrder(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $request->validate([
            'customerCode' => 'required',
            'orderDate' => 'required|date',
            'personnelCode' => 'required',
            'personnelName' => 'required',
            'companyName' => 'required',
            'description' => 'required',
            'orderStatus' => 'required|in:SHIPPED,CANCELLED,IN_PROGRESS,COMPLETED,APPROVED',
            'status' => 'required|in:ACTIVE,PASSIVE',
        ], [
            'customerCode.required' => 'Müşteri tanımı alanı zorunludur.',
            'orderDate.required' => 'Sipariş tarihi alanı zorunludur.',
            'orderDate.date' => 'Geçerli bir tarih seçmelisiniz.',
            'personnelCode.required' => 'Personel kodu alanı zorunludur.',
            'personnelName.required' => 'Personel adı alanı zorunludur.',
            'companyName.required' => 'Firma adı alanı zorunludur.',
            'description.required' => 'Açıklama alanı zorunludur.',
            'orderStatus.required' => 'Sipariş durumu alanı zorunludur.',
            'orderStatus.in' => 'Geçerli bir sipariş durumu seçmelisiniz.',
            'status.required' => 'Durum alanı zorunludur.',
            'status.in' => 'Geçerli bir durum seçmelisiniz.',
        ]);

        $order = Order::create([
            '_id' => Str::uuid(),
            'orderNumber' => $request->orderNumber,
            'customerCode' => $request->customerCode,
            'productDetails' => json_encode($request->products),
            'productDescription' => $request->productDescription,
            'orderDate' => $request->orderDate,
            'dueDate' => $request->dueDate,
            'personnelCode' => $request->personnelCode,
            'personnelName' => $request->personnelName,
            'companyName' => $request->companyName,
            'description' => $request->description,
            'orderStatus' => $request->orderStatus,
            'shippingDate' => $request->shippingDate,
            'note' => $request->note,
            'status' => $request->status,
        ]);

        $productData = [];
        foreach ($request->products as $product) {
            $productData[$product['id']] = [
                'quantity' => $product['quantity'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        $order->products()->sync($productData);

        return redirect()->route('orders')->with('message', 'Sipariş başarıyla oluşturuldu');
    }

    private function updateOrderStatus($orderId)
    {
        $productStatuses = OrderProduct::where('order_id', $orderId)->pluck('status')->toArray();

        if (empty($productStatuses)) {
            return;
        }

        if (count(array_unique($productStatuses)) === 1 && in_array('COMPLETED', $productStatuses)) {
            $newOrderStatus = 'COMPLETED';
        } elseif (count(array_unique($productStatuses)) === 1 && in_array('CANCELLED', $productStatuses)) {
            $newOrderStatus = 'CANCELLED';
        } elseif (array_intersect($productStatuses, ['MANUFACTURING', 'ASSEMBLY', 'ACCOUNTING', 'SHIPPING'])) {
            $newOrderStatus = 'IN_PROGRESS';
        } else {
            return; // Diğer durumları güncelleme
        }

        $order = Order::find($orderId);
        $order->orderStatus = $newOrderStatus;
        $order->save();
    }


    public function updateProductStatus(Request $request)
    {
        $request->validate([
            'orderId' => 'required|integer',
            'productId' => 'required|integer',
            'quantity' => 'required|numeric|min:0.01',
            'currentStatus' => 'required|string|in:ORDER,MANUFACTURING,ASSEMBLY,ACCOUNTING,SHIPPING,CANCELLED,COMPLETED',
            'newStatus' => 'required|string|in:ORDER,MANUFACTURING,ASSEMBLY,ACCOUNTING,SHIPPING,CANCELLED,COMPLETED',
        ]);

        $orderId = $request->orderId;
        $productId = $request->productId;
        $quantity = $request->quantity;
        $currentStatus = $request->currentStatus;
        $newStatus = $request->newStatus;

        // 1. Güncellenmek istenen ürünü bul
        $currentProduct = OrderProduct::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->where('status', $currentStatus)
            ->where('quantity', '>=', $quantity)
            ->first();

        if (!$currentProduct) {
            return redirect()->route('getOrder', ['id' => $orderId])
                ->with('error', 'Güncellenmek istenen durumda yeterli stok bulunamadı');
        }

        // 2. Stok güncelleme veya ürün silme
        $currentProduct->quantity -= $quantity;
        if ($currentProduct->quantity == 0) {
            $currentProduct->delete();
        } else {
            $currentProduct->save();
        }

        // 3. Yeni statü için mevcut ürün var mı kontrol et
        $existingProduct = OrderProduct::where('order_id', $orderId)
            ->where('product_id', $productId)
            ->where('status', $newStatus)
            ->first();

        if ($existingProduct) {
            $existingProduct->quantity += $quantity;
            $existingProduct->save();
        } else {
            OrderProduct::create([
                'order_id' => $orderId,
                'product_id' => $productId,
                'status' => $newStatus,
                'quantity' => $quantity,
            ]);
        }

        // 4. Sipariş durumunu güncelle
        $this->updateOrderStatus($orderId);

        return redirect()->route('getOrder', ['id' => $orderId])
            ->with('message', 'Ürün durumu başarıyla güncellendi');
    }
}
