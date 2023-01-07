<?php

namespace App\Imports;

use App\Models\materiPokok;
use App\Models\soalPilihanBergandaPpk;
use App\Models\standarKomptensi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Crypt;


class soalPilihanBergandaPpkImport implements ToModel, WithHeadingRow {

    public function model(array $row) {

        // $standarKomptensi = standarKomptensi::where('status',1)->get();
        // foreach($standarKomptensi as $item) {
        //     similar_text(strtoupper($item->nama),strtoupper($row['standar_kompetensi']),$persen);
        //     if ($persen > 90) {
        //         $idStandarKompetensi  = $item->id;
        //     }
        // }

        // $materiPokok = materiPokok::where('status',1)->get();
        // foreach ($materiPokok as $item) {
        //     similar_text(strtoupper($item->nama),strtoupper($row['marteri_pokok']),$persen);
        //     if ($persen > 90) {
        //         $idMateriPokok = $item->id;
        //     }
        // }

        // if (strtoupper($row['kriteria']) === 'MUDAH') {
        //     $kriteria = 1;
        // }

        // if (strtoupper($row['kriteria']) === 'SEDANG') {
        //     $kriteria = 2;
        // }

        // if (strtoupper($row['kriteria']) === 'SULIT') {
        //     $kriteria = 3;
        // }

        return new soalPilihanBergandaPpk([
            'id_standar_kompetensi' => $row['id_standar_kompetensi'],
            'id_materi_pokok' => $row['id_materi_pokok'],
            'soal' =>$row['soal'],
            'pil_a' => $row['pil_a'],
            'pil_b' => $row['pil_b'],
            'pil_c' => $row['pil_c'],
            'pil_d' => $row['pil_d'],
            'kunci' => $row['kunci'],
            'nilai_benar' => $row['nilai_benar'],
            'nilai_salah' => $row['nilai_salah'],
            'kriteria' =>  $row['kriteria'],
            'status' => 1
        ]);
    }
}
