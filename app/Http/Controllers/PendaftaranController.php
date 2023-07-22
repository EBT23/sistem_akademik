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
    public function acc_status_pembayaran($id) {
        DB::table('siswa')
            ->where('id_user', $id)
            ->update([
                'status_bayar' => 'Lunas'
            ]);
            return redirect()
            ->route('pendaftaran')
            ->with('success', 'Pembayaran berhasil diverifikasi');
    }
    public function batalkan_status_pembayaran($id) {
        DB::table('siswa')
            ->where('id_user', $id)
            ->update([
                'status_bayar' => 'Pending'
            ]);
            return redirect()
            ->route('pendaftaran')
            ->with('success', 'Pembayaran berhasil dibatalkan');
    }
    public function delete_pendaftaran($id) {
        DB::table('users')
            ->where('id', $id)
            ->delete();

        return redirect() 
            ->route('pendaftaran')
            ->with('success', 'Pendaftaran berhasil dihapus');
    }
}
