<?php

namespace App\Http\Controllers;

use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InformationController extends Controller
{
   public function index()
   {    
        $data['title'] = 'Kelola Informasi';
        $informasi = Information::latest()->get();

        return view('admin.information', compact('informasi'), $data);
   }

   public function add_information(Request $request)
   {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

        Information::create($request->all());

        return redirect()
            ->route('information')
            ->with('success', 'Informasi berhasil ditambahkan.');
   }

   public function update_information(Request $request, $id)
   {
        $request->validate([
            'judul' => 'required',
            'konten' => 'required',
        ]);

         // Cari item berdasarkan id
         $informasi = Information::find($id
        );
    
            // Jika item tidak ditemukan, kembalikan response error 404
            if (!$informasi) {
                return response()->json([
                    'message' => 'Data not found'
                ], 404);
            }
    
            // Update data informasi
    
                $informasi->judul = $request->judul;
                $informasi->updated_at = now();
    
                $informasi->save();

        return redirect()
            ->route('information')
            ->with('success', 'Informasi berhasil diperbarui.');
   }

   public function delete_information($id)
   {
        DB::table('informasi')
            ->where('id', $id)
            ->delete();

        return redirect() 
            ->route('information')
            ->with('success', 'Informasi berhasil dihapus.');
   }
}
