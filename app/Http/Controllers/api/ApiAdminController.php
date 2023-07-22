<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApiAdminController extends Controller
{
    public function information()
    {
        $information = Information::all();

        return response()->json([
            'information' => $information
        ]);
    }
    public function pendaftaran(Request $request){
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            // Tambahkan validasi untuk kolom lainnya sesuai kebutuhan Anda
        ]);

        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Simpan gambar ke direktori public
        $image->move(public_path('uploads'), $imageName);

        // Simpan nama file gambar ke dalam database atau lakukan sesuatu yang lain
        // ...
    }
        $user_id = $this->generateUniqueID();
        $user = DB::table('users')->insert([
            'id'=>$user_id,
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 2,
            'image' => $imageName,
            'created_at' => now()
            // Tambahkan kolom lainnya sesuai dengan struktur tabel users
        ]);
        $nis = $this->generateNIS();
        $tanggalLahir = $request->input('tgl_lahir');
        $umur = date_diff(date_create($tanggalLahir), date_create('today'))->y;
        $metode_bayar = $request->input('metode_bayar');
        if ($metode_bayar == 'Transfer') {
            if ($request->hasFile('bukti_bayar')) {
                $bukti = $request->file('bukti_bayar');
                $bukti_bayar = time() . '.' . $bukti->getClientOriginalExtension();
        
                // Simpan gambar ke direktori public
                $bukti->move(public_path('bukti_bayar'), $bukti_bayar);
        
                // Simpan nama file gambar ke dalam database atau lakukan sesuatu yang lain
                // ...
            }
        }else {
            $bukti_bayar = NULL;
        }
        DB::table('siswa')->insert([
            'id_user' => $user_id,
            'nis' => $nis,
            'ktp' => $request->input('ktp'),
            'kontak' => $request->input('kontak'),
            'kelas' => $request->input('kelas'),
            'alamat' => $request->input('alamat'),
            'umur' => $umur,
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tgl_lahir' => $request->input('tgl_lahir'),
            'pendidikan_terakhir' => $request->input('pendidikan_terakhir'),
            'status' => $request->input('status'),
            'agama' => $request->input('agama'),
            'nama_ortu' => $request->input('nama_ortu'),
            'pengalaman_kerja' => $request->input('pengalaman_kerja'),
            'metode_bayar' => $request->input('metode_bayar'),
            'bukti_bayar' => $bukti_bayar,
            'status_bayar' => 'Pending',
            'created_at'=>now()
            // Tambahkan kolom lainnya sesuai dengan struktur tabel siswa
        ]);

        $data = DB::table('users')
            ->join('siswa', 'users.id', '=', 'siswa.id_user')
            ->select('users.*', 'siswa.*')
            ->where('users.id', $user_id)
            ->first();  
            
            return response()->json(['message' => 'Data pendaftaran berhasil disimpan', 'data' => $data]);
    }
    private function generateNIS()
    {
        $year = date('Y');
        $random = mt_rand(100, 999);
        
        $lastNIS = DB::table('siswa')
                    ->select('nis')
                    ->orderBy('id_siswa', 'desc')
                    ->first();

        $urutan = $lastNIS ? (intval(substr($lastNIS->nis, -6)) + 1) : 1;
        $urutan = str_pad($urutan, 3, '0', STR_PAD_LEFT);
        
        $nis = $year . $random . $urutan;

        return $nis;
    }
    function generateUniqueID()
    {
        $id = mt_rand(1000, 9999);

        // Periksa keunikan nilai ID
        while ($this->isIDExists($id)) {
            $id = mt_rand(1000, 9999);
        }

        return $id;
    }

    function isIDExists($id)
    {
        // Lakukan pengecekan keunikan nilai ID di dalam tabel Anda
        // Gantikan "nama_tabel" dengan nama tabel yang sesuai
        $count = DB::table('users')->where('id', $id)->count();

        return $count > 0;
    }
    public function nilai_ujian()  {
        $userId = Auth::id();
        $nilai_ujian = DB::select("SELECT users.full_name, siswa.nis, nilai_ujian.nil_ujian
                                    FROM users, nilai_ujian, siswa
                                    WHERE users.id = siswa.id_user
                                    AND nilai_ujian.id_siswa = siswa.id_siswa
                                    AND users.id = $userId");
        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $nilai_ujian]);
    }
    public function nilai_lpk() {
        $userId = Auth::id();
        $nilai_lpk = DB::select("SELECT users.full_name, siswa.nis, materi.nama_materi, nilai_lpk.nilai
                                    FROM users, nilai_lpk, siswa, materi
                                    WHERE users.id = siswa.id_user
                                    AND nilai_lpk.id_siswa = siswa.id_siswa
                                    AND materi.id = nilai_lpk.id_materi
                                    AND users.id = $userId");
        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $nilai_lpk]);
    }
    public function jadwal() {
        $jadwal = DB::select("SELECT jadwal.*, materi.nama_materi
                                    FROM jadwal, materi
                                    WHERE jadwal.materi_id = materi.id");
        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $jadwal]);
    }

   public function input_nilai_lpk(Request $request) {
    $validatedData = $request->validate([
        'id_materi' => 'required',
        'id_siswa' => 'required',
        'nilai' => 'required',
    ]);

    $nilai_lpk = DB::table('nilai_lpk')->insert([
        'id_materi' => $validatedData['id_materi'],
        'id_siswa' => $validatedData['id_siswa'],
        'nilai' => $validatedData['nilai']
    ]);

    return response()->json(['message' => 'Nilai berhasil ditambahkan', 'data' => $nilai_lpk]);

    }

    public function update_nilai_lpk(Request $request, $id) {
        // Validasi request
        $validatedData = $request->validate([
            'id_materi' => 'required',
            'id_siswa' => 'required',
            'nilai' => 'required'
        ]);

        // Update data nilai LPK
        $affectedRows = DB::table('nilai_lpk')
            ->where('id', $id)
            ->update([
                'id_materi' => $validatedData['id_materi'],
                'id_siswa' => $validatedData['id_siswa'],
                'nilai' => $validatedData['nilai']
            ]);

        if ($affectedRows) {
            return response()->json(['message' => 'Data nilai LPK berhasil diupdate']);
        }

        return response()->json(['message' => 'Gagal mengupdate data nilai LPK'], 500);
    
    }

    public function delete_nilai_lpk($id)  {
        $deletedRows = DB::table('nilai_lpk')
            ->where('id', $id)
            ->delete();

        if ($deletedRows) {
            return response()->json(['message' => 'Data nilai LPK berhasil dihapus']);
        }

        return response()->json(['message' => 'Gagal menghapus data nilai LPK'], 500);
    }
    public function get_siswa() {
        $siswa = DB::select("SELECT siswa.id_siswa, users.full_name, siswa.nis 
                                FROM siswa, users 
                                WHERE siswa.id_user = users.id");

        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $siswa]);
    }
    public function get_siswa_by_id()  {
        $id_user = Auth::id();
        $siswa = DB::select("SELECT siswa.id_siswa, users.full_name, siswa.nis 
                                FROM siswa, users 
                                WHERE siswa.id_user = users.id
                                AND users.id = $id_user");

        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $siswa]);
    }
    public function materi(){
        $materi = DB::select("SELECT *
        FROM materi");

        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $materi]);
    }
    public function nilailpk_by_siswa() {
        $id_user = Auth::id();
        $nilailpk_by_siswa = DB::select("SELECT nilai_lpk.*, materi.nama_materi, users.full_name, siswa.nis
                                FROM nilai_lpk, materi, users, siswa
                                WHERE nilai_lpk.id_materi = materi.id
                                AND nilai_lpk.id_user = users.id
                                AND users.id = siswa.id_user
                                AND users.id = $id_user");

        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $nilailpk_by_siswa]);
    }
    public function nilaiujian_by_siswa() {
        $id_user = Auth::id();
        $nilaiujian_by_siswa = DB::select("SELECT nilai_ujian.*,  users.full_name, siswa.nis
                                FROM nilai_ujian, users, siswa
                                WHERE nilai_ujian.id_siswa = siswa.id_siswa
                                AND users.id = siswa.id_user
                                AND users.id = $id_user");

        return response()->json(['message' => 'Data berhasi ditampilkan', 'data' => $nilaiujian_by_siswa]);
    }
}
