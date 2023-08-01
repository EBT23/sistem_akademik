<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai_ujian extends Model
{
    use HasFactory;

    protected $table = 'nilai_ujian';
    protected $fillable = [

      
        'id_siswa',
       'nil_ujian'
    ];
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }
}
