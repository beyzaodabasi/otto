<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Http\HttpClient;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER') {
            return redirect()->route('home');
        }
        return view('employee.index');
    }

    public function getEmployeesData(Request $request)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER') {
            return redirect()->route('home');
        }
        if ($request->ajax()) {
            $employees = User::select(['id', 'created_at', 'email', 'name', 'userName', 'userType', 'unit', 'status'])
                ->where('userType', '!=', 'ADMIN')
                ->get();

            return DataTables::of($employees)
                ->editColumn('created_at', function ($employee) {
                    return $employee->created_at->format('Y-m-d H:i');
                })
                ->editColumn('userType', function ($employee) {
                    return $employee->userType == 'MEMBER' ? 'Çalışan' : 'Yönetici';
                })
                ->editColumn('unit', function ($employee) {
                    switch ($employee->unit) {
                        case 'ADMIN':
                            return 'Admin';
                        case 'MANAGER':
                            return 'Yönetici';
                        case 'ACCOUNTING':
                            return 'Muhasebe';
                        case 'SALES':
                            return 'Satış';
                        case 'MANUFACTURING':
                            return 'İmalat';
                        case 'ASSEMBLY':
                            return 'Montaj';
                        case 'CARGO':
                            return 'Kargo';
                        default:
                            return 'Yönetici';
                    }
                })
                ->editColumn('status', function ($employee) {
                    return $employee->status == 'ACTIVE' ? 'Aktif' : 'Pasif';
                })
                ->addColumn('actions', function ($employee) {
                    return '<a href="' . route('getEmployee', ['id' => $employee->id]) . '" class="btn btn-primary btn-sm">Detay</a>';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function getEmployee(Request $request, $id)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER') {
            return redirect()->route('home');
        }
        $employee = User::find($id);
        return view('employee.updateEmployee', compact('employee'));
    }

    public function updateEmployee(Request $request, $id)
    {
        if (Auth::user()->userType != 'ADMIN' && Auth::user()->unit != 'MANAGER') {
            return redirect()->route('home');
        }
        $employee = User::find($id);
        $employee->email = $request->email;
        $employee->name = $request->name;
        $employee->userName = $request->userName;
        $employee->unit = $request->unit;
        $employee->status = $request->status;
        if ($request->password != null) {
            $employee->password = Hash::make($request->password);
        }
        $employee->save();
        return redirect()->route('employees')->with('message', 'Çalışan güncellendi');
    }
}