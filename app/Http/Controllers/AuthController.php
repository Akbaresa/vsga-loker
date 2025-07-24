<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        try {
            $karyawan = Karyawan::where('email', $credentials['email'])->first();

            if (!$karyawan) {
                return Response::json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            if (!Hash::check($credentials['password'], $karyawan->password)) {
                return Response::json([
                    'message' => 'Email atau password salah',
                ], 401);
            }

            $redirectPath = '';
            if($karyawan->is_admin){
                Auth::guard('admin')->login($karyawan);
                $redirectPath = '/karyawan/admin/lowongan';
            }else {
                Auth::guard('karyawan')->login($karyawan);
                $redirectPath = '/karyawan/view-lowongan';
            }

            $request->session()->regenerate();

            return Response::json([
                'message' => 'Berhasil login',
                'redirect' => $redirectPath,
            ]);
        } catch (QueryException $exception) {
            return $this->queryExceptionResponse($exception);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('karyawan.login');
    }
}
