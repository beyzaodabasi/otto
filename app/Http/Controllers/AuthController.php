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

class AuthController extends Controller
{
    public function createUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'userName' => 'required|string|max:255|unique:users,userName',
            'password' => 'required|min:6',
            'userType' => 'required|in:MEMBER,ADMIN',
            'unit' => 'required|in:ADMIN,MANAGER,ACCOUNTING,SALES,MANUFACTURING,ASSEMBLY,CARGO',
        ]);
        $user = User::create([
            '_id' => Str::uuid(),
            'email' => $request->email,
            'name' => $request->name,
            'userName' => $request->userName,
            'password' => Hash::make($request->password),
            'userType' => $request->userType,
            'unit' => $request->unit,
        ]);
        return Response::json([
            'message' => 'User created successfully',
            'user' => $user
        ], 201);
    }
    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function loginpost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect('/login')->with('error_message', 'Kullanıcı adı veya şifre hatalı');
        }

        if ($user->status == 'PASSIVE') {
            return redirect('/login')->with('error_message', 'Hesabınız aktif değil. Giriş yapamazsınız.');
        }

        Auth::login($user);
        // return redirect()->intended();
        return redirect()->intended('/')->with('success', 'Giriş başarılı');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
