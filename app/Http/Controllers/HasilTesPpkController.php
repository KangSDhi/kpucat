<?php

namespace App\Http\Controllers;

use App\Models\HasilTesPpk;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HasilTesPpkExport;
use App\Models\kelasTesPpk;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade;
use Facade\Ignition\DumpRecorder\Dump;
use PDF;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

class HasilTesPpkController extends Controller {


    public function __construct()
    {
        $this->middleware(['auth','statusKelasTesPpk','statusAdminCat']);
    }

    public function index() {
        $hasil = HasilTesPpk::orderBy('nama', 'ASC')->get();
        $kelas = collect($hasil)->pluck('kelas')->unique();
        return view('ppk.hasil.index',[
            'hasilTesPpk' => $hasil,
            'kelas' => $kelas
        ]);
    }

    public function exportPengumuman(Request $request) {

        $kelas = $request->kelas;
        $wilayah = $request->wilayah;
        $kelurahan = $request->kelurahan;

        if ($request->submit == 'cetakPdf') {

            $hasil = DB::table('hasil_tes_ppks')
                        ->when($kelas, function($query,$kelas) {
                            return $query->where('kelas',$kelas);
                        })
                        ->when($wilayah, function ($query,$wilayah){
                            return $query->where('wilayah',$wilayah);
                        })
                        ->OrderBy('nama','ASC')
                    ->get();

            $token = Crypt::encryptString(date('Y-m-d_H-i-s'));

            $qrcode = base64_encode(QrCode::format('svg')->size(50)->generate(date('YHismd')));

            // dd(Crypt::decrypt('eyJpdiI6IlFEaXgzNVYzWFh6VW9scWlIZEZwUmc9PSIsInZhbHVlIjoiNTZmSU1JVzRxVWpBMFZid2JJdllucklEVy9IVlFaMWEwcmxpalpmQlh0THhwWklaZ0lRRWhqbGMzeXg2bzF6TiIsIm1hYyI6ImY4NTU2YzVhZGIxZDBhYzE4MjViZTI0MmRhYjU1Njg2YjE2MGMyZmViMGM0OTZjNmMzMmIzYmRlOWY5YmNmZmQiLCJ0YWciOiIifQ=='));

            // dd($qrcode);

            $pdf = PDF::loadView('ppk.hasil.export-pdf', [
                        'hasil' => $hasil,
                        'kelas' => $kelas,
                        'wilayah' => $wilayah,
                        'qrcode' => $qrcode
                    ])->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('Laporan_Hasil_Tes'.date('Y-m-d_H-i-s'));
            // return $pdf->download('Laporan_Hasil_Tes'.date('Y-m-d_H-i-s').'pdf');
        }

        if ($request->submit == 'exportExcel') {

            $nama_file = 'hasil_tes_ppk_'.date('Y-m-d_H-i-s').'.xlsx';
            return Excel::download(new HasilTesPpkExport($kelas,$wilayah), $nama_file);
        }
    }

    public function getWilayah($kelas) {

        $hasil = HasilTesPpk::where('kelas',$kelas)->orderBy('wilayah', 'ASC')->get();
        $course = collect($hasil)->unique('wilayah');
        return response()->json($course);
    }
}
