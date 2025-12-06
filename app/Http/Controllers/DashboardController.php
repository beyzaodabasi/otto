<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\HttpClient;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $previousYear = $currentYear - 1;

        $dataCurrentYear = [];
        $dataPreviousYear = [];

        // 1-12 ayları üzerinden sipariş adetlerini toplayalım
        for ($month = 1; $month <= 12; $month++) {
            // Bu yıl ilgili ayın sipariş adedi
            $countCurrent = Order::whereYear('orderDate', $currentYear)
                ->whereMonth('orderDate', $month)
                ->count();

            // Geçen yıl ilgili ayın sipariş adedi
            $countPrevious = Order::whereYear('orderDate', $previousYear)
                ->whereMonth('orderDate', $month)
                ->count();

            $dataCurrentYear[] = $countCurrent;
            $dataPreviousYear[] = $countPrevious;
        }

        // Yıllık toplam sipariş adedini hesaplayalım
        $totalCurrent = array_sum($dataCurrentYear);
        $totalPrevious = array_sum($dataPreviousYear);

        // Yüzde değişim hesaplaması
        $percentageChange = 0;
        if ($totalPrevious > 0) {
            $percentageChange = (($totalCurrent - $totalPrevious) / $totalPrevious) * 100;
        }

        // İçerisinde bulunduğumuz ayın sipariş adedi
        $currentMonth = Carbon::now()->month;
        $currentMonthOrderCount = Order::whereYear('orderDate', $currentYear)
            ->whereMonth('orderDate', $currentMonth)
            ->count();

        // OrderProduct tablosundan İmalatta olan ürünler
        $manufacturingCount = (int) OrderProduct::where('status', 'MANUFACTURING')->sum('quantity');

        // OrderProduct tablosundan Montajda olan ürünler
        $assemblyCount = (int) OrderProduct::where('status', 'ASSEMBLY')->sum('quantity');

        // OrderProduct tablosundan Muhasebede olan ürünler
        $accountingCount = (int) OrderProduct::where('status', 'ACCOUNTING')->sum('quantity');

        // OrderProduct tablosundan Sevk/Depo'da olan ürünler
        $shippingCount = (int) OrderProduct::where('status', 'SHIPPING')->sum('quantity');

        $employees = User::select(['id', 'created_at', 'email', 'name', 'userName', 'userType', 'unit', 'status'])
            ->where('userType', '!=', 'ADMIN')
            ->where('status', 'ACTIVE')
            ->get();

        // View'a gerekli verileri gönderiyoruz
        return view('dashboard.index', [
            'dataCurrentYear' => $dataCurrentYear,
            'dataPreviousYear' => $dataPreviousYear,
            'percentageChange' => $percentageChange,
            'totalPrevious' => $totalPrevious,
            'currentMonthOrderCount' => $currentMonthOrderCount,
            'manufacturingCount' => $manufacturingCount,
            'assemblyCount' => $assemblyCount,
            'accountingCount' => $accountingCount,
            'shippingCount' => $shippingCount,
            'employees' => $employees
        ]);
    }

    public function dashboard(Request $request)
    {

    }

}