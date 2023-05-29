<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function student()
    {
        $data['title'] = 'Keloa Siswa';
        $student = DB::table('siswa')
        ->join('users','users.id','=','siswa.id_user')
        ->select('siswa.*','users.id', 'users.full_name','users.email')
        ->where('users.role','=','2')
        ->get();


        return view('admin.student',['student' => $student], $data);
    }

    public function add_student(Request $request)
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
                'role' => 2,
                'created_at' => now(),
            ];
            $siswa = [
                'id_user' => $id_user,
                'kontak' => $request->kontak,
                'alamat' => $request->alamat,
                'umur' => $request->umur,
                'created_at' => time(),
            ];

            DB::table('users')->insert($user);
            DB::table('siswa')->insert($siswa);
            
            return redirect()
            ->route('student')
            ->with('success', 'Akun berhasil dibuat');
    }

    public function delete_student($id)
    {
        
        DB::beginTransaction();

        try {
            DB::table('users')
                ->where('id', $id)
                ->delete();

            DB::table('siswa')
                ->where('id_user', $id)
                ->delete();

            DB::commit();

            return redirect()
                ->route('student')
                ->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('student')
                ->with('error', 'Gagal menghapus data.');
        }
    }
}
