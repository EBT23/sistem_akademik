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
        $pendaftarBelumLunas = DB::select("SELECT COUNT(siswa.id_siswa) as jumlah FROM siswa WHERE siswa.status_bayar = 'Pending'");
        $pendaftarBelumLunas = $pendaftarBelumLunas[0]->jumlah;
        $pendaftarLunas = DB::select("SELECT COUNT(siswa.id_siswa) as jumlah FROM siswa WHERE siswa.status_bayar = 'Lunas'");
        $pendaftarLunas = $pendaftarLunas[0]->jumlah;

        // count pengajar
        $role = 3; 
        $pengajarCount = DB::table('users')->where('role', $role)->count();

        return view('dashboard',  compact('siswaCount','pengajarCount','pendaftarBelumLunas','pendaftarLunas'), $data);
    }
}
