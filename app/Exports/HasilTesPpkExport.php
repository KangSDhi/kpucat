<?php

namespace App\Exports;

use App\Models\HasilTesPpk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\DB;

class HasilTesPpkExport implements FromView {

    public function  __construct($kelas,$wilayah) {
        $this->kelas= $kelas;
        $this->wilayah = $wilayah;
    }

    public function view(): View {

        $kelas = $this->kelas;
        $wilayah =  $this->wilayah;
        $hasil = DB::table('hasil_tes_ppks')
                ->when($kelas, function($query,$kelas) {
                    return $query->where('kelas',$kelas);
                })
                ->when($wilayah, function ($query,$wilayah){
                    return $query->where('wilayah',$wilayah);
                })
                ->OrderBy('nama','ASC')
                ->get();

        return view('ppk.hasil.export', [
            'hasilTesPpk' => $hasil,
            'kelas' => $kelas
        ]);
    }
}
