<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Http\HttpClient;

class ManagementController extends Controller
{
    public function index(Request $request)
    {
        return view('management.index');
    }

}