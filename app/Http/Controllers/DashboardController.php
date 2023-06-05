<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        
        // count siswa
        $role = 2; 
        $siswaCount = DB::table('users')->where('role', $role)->count();

        // count pengajar
        $role = 3; 
        $pengajarCount = DB::table('users')->where('role', $role)->count();

        return view('dashboard',  compact('siswaCount','pengajarCount'), $data);
    }
}
