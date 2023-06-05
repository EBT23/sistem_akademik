<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function student()
    {
        $data['title'] = 'Keloa Siswa';
        $getSiswa = DB::table('siswa')->get();
        $student = DB::table('siswa')
        ->join('users','users.id','=','siswa.id_user')
        ->select('siswa.*','users.id', 'users.full_name','users.email')
        ->where('users.role','=','2')
        ->get();


        return view('admin.student',['student' => $student, 'getSiswa' => $getSiswa], $data);
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
                'kelas' => 'required|in:Dasar,Advanced',
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
                'kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'umur' => $request->umur,
                'created_at' => now(),
            ];

            DB::table('users')->insert($user);
            DB::table('siswa')->insert($siswa);
            
            return redirect()
            ->route('student')
            ->with('success', 'Akun berhasil dibuat');
    }

    public function update_student(Request $request, $id)
    {
         // Validasi input menggunakan Laravel Validator
        $validator = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email',
            'kontak' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
            'umur' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Update data di tabel users
            User::where('id', $id)
                ->update([
                    'full_name' => $request->input('full_name'),
                    'email' => $request->input('email'),
                ]);

            // Update data di tabel siswa
            Siswa::where('id_user', $id)
                ->update([
                    'kontak' => $request->input('kontak'),
                    'kelas' => $request->input('kelas'),
                    'alamat' => $request->input('alamat'),
                    'umur' => $request->input('umur'),
                    'updated_at' => now(),
                ]);

            DB::commit();

            return redirect()->back()->with('success', 'Data siswa berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal memperbarui data siswa.')->withInput();
        }
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
