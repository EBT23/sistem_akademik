<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    public function schedule()
    {
        $data['title'] = 'Kelola Jadwal';

        $materi = DB::table('materi')->get();
        $schedule = DB::table('jadwal')
        ->join('materi','materi.id','=','jadwal.materi_id')
        ->select('jadwal.*','materi.nama_materi')
        ->get();

        return view('admin.schedule',['schedule' => $schedule ,'materi' => $materi], $data);
    }

    public function add_schedule(Request $request)
    {
        $request->validate([
            'materi_id' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
            'hari' => 'required',
        ]);
           
            $data = [
                
                'materi_id' => $request->materi_id,
                'dari' => $request->dari,
                'sampai' => $request->sampai,
                'hari' => $request->hari,
                'is_active' => $request->has('is_active'),
                'created_at' => now()
            ];
            
            DB::table('jadwal')->insert($data);
            
            return redirect()
            ->route('schedule')
            ->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function update_schedule(Request $request, $id)
    {
         // Validasi request
         $request->validate([
            'materi_id' => 'required',
           
        ]);

         // Cari item berdasarkan id
        $schedule = Schedule::find($id);

        // Jika item tidak ditemukan, kembalikan response error 404
        if (!$schedule) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Update data jadwal
            $schedule->materi_id = $request->materi_id;
            $schedule->dari = $request->dari;
            $schedule->sampai = $request->sampai;
            $schedule->hari = $request->hari;
            $schedule->is_active = $request->is_active;
            $schedule->updated_at = now();

            $schedule->save();

        // kembali ke halaman jadwal
        return redirect()
            ->route('schedule')
            ->with('success', 'Jadwal berhasil diedit');
    }

    public function delete_schedule($id)
    {
        DB::table('jadwal')
            ->where('id', $id)
            ->delete();

        return redirect() 
            ->route('schedule')
            ->with('success', 'Jadwal berhasil dihapus');
    }
}
