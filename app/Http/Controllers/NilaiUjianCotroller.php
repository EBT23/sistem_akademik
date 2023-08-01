<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NilaiUjianCotroller extends Controller
{
    public function nilai_ujian()
    {
        $data['title'] = 'Kelola Nilai Ujian';
        $nilai_ujian = DB::table('nilai_ujian')
                            ->join('siswa', 'nilai_ujian.id_siswa', '=', 'siswa.id_siswa')
                            ->join('users', 'siswa.id_user', '=', 'users.id')
                            ->select('nilai_ujian.id','users.full_name', 'siswa.nis', 'nilai_ujian.nil_ujian')
                            ->get();
        $siswa = DB::table('users')
            ->join('siswa', 'users.id', '=', 'siswa.id_user')
            ->select('users.full_name', 'siswa.nis', 'siswa.id_siswa')
            ->get();

            $nilai_lpk = DB::table('nilai_lpk')
            ->join('siswa', 'nilai_lpk.id_siswa', '=', 'siswa.id_siswa')
            ->join('users', 'siswa.id_user', '=', 'users.id')
            ->join('materi', 'nilai_lpk.id_materi', '=', 'materi.id')
            ->select('nilai_lpk.id','users.full_name', 'siswa.nis', 'nilai_lpk.nilai', 'materi.nama_materi')
            ->get();
         
        return view('admin.nilai_ujian', compact('nilai_ujian', 'siswa','nilai_lpk'),$data);
    }

    public function add_nilai_ujian(Request $request)
    {
        $request->validate(['nil_ujian' => 'required',
                            'siswa' => 'required'
                            ], );
           
            $data = [
                
                'id_siswa' => $request->siswa,
                'nil_ujian' => $request->nil_ujian
            ];
            
            DB::table('nilai_ujian')->insert($data);
            
            return redirect()
            ->route('nilai_ujian')
            ->with('success', 'Nilai ujian berhasil ditambahkan');
    }
    public function update_nilai_ujian(Request $request, $id)  {

        $request->validate(['nil_ujian' => 'required',
        'siswa' => 'required'
        ], );

        $data = [
        'id_siswa' => $request->siswa,
        'nil_ujian' => $request->nil_ujian
        ];
        DB::table('nilai_ujian')
        ->where('id', $id)
        ->update($data);
        return redirect()
            ->route('nilai_ujian')
            ->with('success', 'Nilai ujian berhasil diubah');
    }
    // public function update_materi(Request $request, $id)
    // {
    //     // Validasi request
    //     $request->validate([
    //         'nama_materi' => 'required',
           
    //     ]);

    //      // Cari item berdasarkan id
    //     $materi = Materi::find($id
    // );

    //     // Jika item tidak ditemukan, kembalikan response error 404
    //     if (!$materi) {
    //         return response()->json([
    //             'message' => 'Data not found'
    //         ], 404);
    //     }

    //     // Update data count manager

    //         $materi->nama_materi = $request->nama_materi;
    //         $materi->updated_at = now();

    //         $materi->save();

    //     return redirect()
    //         ->route('materi')
    //         ->with('success', 'Materi berhasil diedit');
    // }

    // public function delete_materi($id)
    // {
    //     DB::table('materi')
    //         ->where('id', $id)
    //         ->delete();

    //     return redirect() 
    //         ->route('materi')
    //         ->with('success', 'Materi berhasil dihapus');
    // }
}
