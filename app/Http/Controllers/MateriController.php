<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MateriController extends Controller
{
    public function materi()
    {
        $data['title'] = 'Kelola Materi';
        $materi = DB::table('materi')->get();

        return view('admin.materi', ['materi' => $materi],$data);
    }

    public function add_materi(Request $request)
    {
        $request->validate(['nama_materi' => 'required']);
           
            $data = [
                
                'nama_materi' => $request->nama_materi,
                'created_at' => now()
            ];
            
            DB::table('materi')->insert($data);
            
            return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil ditambahkan');
    }

    public function update_materi(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'nama_materi' => 'required',
           
        ]);

         // Cari item berdasarkan id
        $materi = Materi::find($id
    );

        // Jika item tidak ditemukan, kembalikan response error 404
        if (!$materi) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Update data count manager

            $materi->nama_materi = $request->nama_materi;
            $materi->updated_at = now();

            $materi->save();

        return redirect()
            ->route('materi')
            ->with('success', 'Materi berhasil diedit');
    }

    public function delete_materi($id)
    {
        DB::table('materi')
            ->where('id', $id)
            ->delete();

        return redirect() 
            ->route('materi')
            ->with('success', 'Materi berhasil dihapus');
    }
}
