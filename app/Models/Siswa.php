<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [

        'id_siswa' ,
        'id_angkatan',
        'id_user',
        'kontak',
        'umur',
        'alamat',
    ];

    public function user()
    {
        // Ubah argumen kedua menjadi sesuai dengan foreign key yang ada di tabel 'siswa'
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    // protected $enumKelas = ['Dasar', 'Advanced'];

    // public function getKelasOptions()
    // {
    //     return $this->enumKelas;
    // }
}
