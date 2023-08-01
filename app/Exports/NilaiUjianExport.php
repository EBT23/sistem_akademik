<?php

// app/Exports/NilaiUjianExport.php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiUjianExport implements FromCollection, WithHeadings
{
    protected $nilaiUjian;

    public function __construct(Collection $nilaiUjian)
    {
        $this->nilaiUjian = $nilaiUjian;
    }

    public function collection()
    {
        return $this->nilaiUjian->map(function ($nilai) {
            return [
                'ID Siswa' => $nilai->id_siswa,
                'Nama Siswa' => $nilai->siswa->user->full_name,
                'Nilai Ujian' => $nilai->nil_ujian,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Siswa',
            'Nama Siswa',
            'Nilai Ujian',
        ];
    }
}
