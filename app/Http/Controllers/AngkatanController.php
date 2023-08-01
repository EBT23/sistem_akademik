<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AngkatanController extends Controller
{
    public function angkatan()
    {
        $data['title'] = 'Kelola Angkatan';
        $angkatan = DB::table('angkatan')->get();

        return view('admin.angkatan', ['angkatan' => $angkatan],$data);
    }

    public function add_angkatan(Request $request)

    {
        // dd($request);
        $request->validate(['thn_angkatan' => 'required']);
           
            $data = [
                
                'thn_angkatan' => $request->thn_angkatan,
                'is_active' => $request->is_active,
            ];
            
            DB::table('angkatan')->insert($data);
            
            return redirect()
            ->route('angkatan')
            ->with('success', 'Angkatan berhasil ditambahkan');
    }

    public function update_angkatan(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'thn_angkatan' => 'required',
           
        ]);

         // Cari item berdasarkan id
        $angkatan = Angkatan::find($id
    );

        // Jika item tidak ditemukan, kembalikan response error 404
        if (!$angkatan) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Update data count manager

            $angkatan->thn_angkatan = $request->thn_angkatan;
            $angkatan->is_active = $request->is_active;

            $angkatan->save();

        return redirect()
            ->route('angkatan')
            ->with('success', 'Angkatan berhasil diedit');
    }

    public function delete_angkatan($id)
    {
        DB::table('angkatan')
            ->where('id', $id)
            ->delete();

        return redirect() 
            ->route('angkatan')
            ->with('success', 'Angkatan berhasil dihapus');
    }
}
