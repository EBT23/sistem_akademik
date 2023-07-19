<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendaftaranController extends Controller
{
    public function pendaftaran() {
        $data['title'] = 'Kelola Pendaftaran';
        $pendaftaran = DB::table('siswa')
                            ->join('users', 'siswa.id_user', '=', 'users.id')
                            ->select('siswa.*','users.full_name', 'users.email', 'users.id')
                            ->get();
                            

        return view('admin.pendaftaran', compact('pendaftaran'),$data);
    }
}
