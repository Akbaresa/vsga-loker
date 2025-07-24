<?php 

use Illuminate\Support\Facades\Auth;

if (!function_exists('id_karyawan')) {
    function id_karyawan() {
        return Auth::guard('karyawan')->user()->id_karyawan ?? null;
    }
}
if (!function_exists('id_admin')) {
    function id_admin() {
        return Auth::guard('admin')->user()->id_karyawan ?? null;
    }
}
if (!function_exists('karyawan')) {
    function karyawan() {
        return Auth::guard('karyawan')->user() ?? null;
    }
}
if (!function_exists('admin')) {
    function admin() {
        return Auth::guard('admin')->user() ?? null;
    }
}