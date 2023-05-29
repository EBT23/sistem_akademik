<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function teacher()
    {
        $data['title'] = 'Kelola Pengajar ';
        $teacher = DB::table('pengajar')
        ->join('users','users.id','=','pengajar.id_user')
        ->select('pengajar.*','users.id', 'users.full_name','users.email')
        ->where('users.role','=','3')
        ->get();

        return view('admin.teacher',['teacher' => $teacher], $data);
    }

    public function add_teacher(Request $request)
    {
        $request->validate(
            [
                'full_name' => 'required',
                'email' => 'required|unique:users,email',
                // 'password' => 'required|min:8'
            ],
            [
                'kontak' => 'required',
                'alamat' => 'required',
                'umur' => 'required',
            ]);

            $id_user = rand(00000, 99999);
            $user = [
                'id' =>  $id_user,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => bcrypt('siakadlpk999'),
                'role' => 3,
                'created_at' => now(),
            ];
            $pengajar = [
                'id_user' => $id_user,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
                'umur' => $request->umur,
                'created_at' => time(),
            ];

            DB::table('users')->insert($user);
            DB::table('pengajar')->insert($pengajar);
            
            return redirect()
            ->route('teacher')
            ->with('success', 'Akun berhasil dibuat');
    }

    public function delete_teacher($id)
    {
        
        DB::beginTransaction();

        try {
            DB::table('users')
                ->where('id', $id)
                ->delete();

            DB::table('pengajar')
                ->where('id_user', $id)
                ->delete();

            DB::commit();

            return redirect()
                ->route('teacher')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('teacher')
                ->with('error', 'Gagal menghapus data.');
        }
    }
}
