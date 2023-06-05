<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = [

        'id_siswa',
        'id_user',
        'kontak',
        'umur',
        'alamat',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // protected $enumKelas = ['Dasar', 'Advanced'];

    // public function getKelasOptions()
    // {
    //     return $this->enumKelas;
    // }
}
