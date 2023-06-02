<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Schedule extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $fillable = [

        'id',
        'materi_id',
        'dari',
        'sampai',
        'hari',
        'is_active'
    ];
}
