<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\HttpClient;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        return view('product.index');
        // $products = Product::all();
        // return view('product.index', compact('products'));
    }

    public function getProductsData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $products = Product::select(['id', 'created_at', 'specialCodeDescription', 'type', 'specialCode', 'code', 'description', 'groupCode', 'mainUnit', 'status']);

            return DataTables::of($products)
                ->editColumn('created_at', function ($product) {
                    return $product->created_at->format('Y-m-d H:i');
                })
                ->editColumn('status', function ($product) {
                    return $product->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
                })
                ->addColumn('actions', function ($product) {
                    return '<a href="' . route('getProduct', ['id' => $product->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function newProduct(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        return view('product.newProduct');
    }

    public function createProduct(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $request->validate([
            'specialCodeDescription' => 'required|in:P.SİLİNDİR,D.PNÖMATİK,VAKUM,D.HİDROLİK,H.ÜNİTE,H.POMPA,H.HORTUM,KATALOG,NONE',
            'type' => 'required|in:YM,TM,SK,HM,MM,OTHER',
            'code' => 'required|unique:products,code',
            'description' => 'required|string',
            'mainUnit' => 'required|in:AD,MT,KG',
            'status' => 'required|in:ACTIVE,PASSIVE',
        ], [
            'specialCodeDescription.required' => 'Özel Kod Açıklaması alanı zorunludur.',
            'specialCodeDescription.in' => 'Özel Kod Açıklaması geçersiz bir değer içeriyor.',
            'type.required' => 'Tür alanı zorunludur.',
            'type.in' => 'Seçilen tür geçersizdir.',
            'code.required' => 'Kod alanı zorunludur.',
            'code.unique' => 'Bu kodlu ürün zaten mevcut.',
            'description.required' => 'Açıklama alanı zorunludur.',
            'mainUnit.required' => 'Ana birim seçilmelidir.',
            'mainUnit.in' => 'Geçerli bir ana birim seçmelisiniz.',
            'status.required' => 'Durum alanı zorunludur.',
            'status.in' => 'Seçilen durum geçersizdir.',
        ]);
        $product = Product::create([
            '_id' => Str::uuid(),
            'specialCodeDescription' => $request->specialCodeDescription,
            'type' => $request->type,
            'specialCode' => $request->specialCode,
            'code' => $request->code,
            'description' => $request->description,
            'groupCode' => $request->groupCode,
            'mainUnit' => $request->mainUnit,
            'status' => $request->status,
        ]);
        return redirect()->route('products')->with('message', 'Ürün başarıyla oluşturuldu.');
    }

    public function getProduct(Request $request, $id)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $product = Product::find($id);
        return view('product.updateProduct', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER' && Auth::user()->unit != 'SALES') {
            return redirect()->route('home');
        }
        $product = Product::find($id);
        $product->specialCodeDescription = $request->specialCodeDescription;
        $product->type = $request->type;
        $product->specialCode = $request->specialCode;
        $product->groupCode = $request->groupCode;
        $product->mainUnit = $request->mainUnit;
        $product->status = $request->status;
        $product->save();
        return redirect()->route('products')->with('message', 'Ürün başarıyla güncellendi.');
    }

    public function importProducts(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN') {
            return redirect()->route('home');
        }
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ], [
            'file.required' => 'Dosya yüklemelisiniz.',
            'file.mimes' => 'Geçerli bir dosya yüklemelisiniz.',
            'file.max' => 'Dosya boyutu 2MB\'dan küçük olmalıdır.',
        ]);

        try {
            // Dosya yükleme işlemi
            Excel::import(new ProductImport, $request->file('file'));

            // İşlem başarılıysa yönlendirme yap
            return redirect()->route('products')->with('message', 'Ürünler başarıyla yüklendi.');
        } catch (\Exception $e) {
            dd(vars: $e);
            // Hata oluşursa geri dön ve hata mesajı göster
            return back()->with('error', 'Ürünler yüklenirken bir hata oluştu: ' . $e->getMessage());
        }
    }


}