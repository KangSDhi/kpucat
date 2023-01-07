<?php

namespace App\Http\Controllers;

use App\Exports\KelasTesPpkExport;
use App\Imports\PpkImport;
use App\Models\kelasTesPpk;
use App\Models\kelasUjian;
use App\Models\materiPokok;
use App\Models\pesertaTesPpk;
use App\Models\standarKomptensi;
use App\Models\soalPilihanBergandaPpk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\DB;


class KelasTesPpkController extends Controller {
    public function __construct() {
        $this->middleware([
            'auth',
            'statusAdminCat',
            'statusKelasTesPpk'
        ]);
    }

    public function index() {

        $kelasPpk = kelasTesPpk::orderBy('nama_kelas', 'asc')->paginate(10);
        return view('ppk.kelas.indexOld',[
            'kelasPpk' => $kelasPpk
        ]);
    }

    public function create() {

        $soal = DB::select('SELECT * FROM soal_pilihan_berganda_ppks');
        if ($soal) {
            return view('ppk.kelas.create');
        }
        return redirect()->back()->with('status', 'Soal belum Tersedia. Pastikan Soal sudah diimport');
    }


    public function edit(kelasTesPpk $kelasTesPpk,$idKelas) {

        return view('ppk.kelas.edit',[
            'idKelas' => $idKelas
        ]);
    }


    public function destroy(kelasTesPpk $kelasTesPpk,$idKelas) {

        $pesertaTesPpk = pesertaTesPpk::where('id_kelas',$idKelas)->get();
        if (count($pesertaTesPpk) == 0) {
            $kelasTesPpk = kelasTesPpk::find($idKelas);
            $kelasTesPpk->delete();
        }
        return redirect()->back();
    }

    public function deaktivasi(kelasTesPpk $kelasTesPpk,$idKelas) {

        $kelasTesPpk = kelasTesPpk::find($idKelas);
        $kelasTesPpk->status = 0;
        $kelasTesPpk->save();

        // dump($idKelas);
        // dump($kelasTesPpk);
        // die;
        return redirect()->back();
    }


    public function export($idKelasTesPpk) {

    // return 'tes';

    return Excel::download(new KelasTesPpkExport($idKelasTesPpk), 'DaftarKelasTes.xlsx');
    }

    public function show($id)
    {
        $kelas = kelasTesPpk::find($id);

        $komposisi_decoded = json_decode($kelas->json_komposisi_soal_ganda);
        $komposisi_collect = collect($komposisi_decoded)->groupBy('nama_materi_pokok');
        // $komposisi = collect();

        // dd($komposisi_collect);


        foreach ($komposisi_collect as $i => $value) {
            /* $materiPokok = materiPokok::find($id);
            $mudah = '';
            $sedang = '';
            $sulit = '';
            // dd($value[2]->kriteria);
            // if(isset($value[0])){
                if(isset($value[0]) && $value[0]->kriteria = 1){
                    $mudah = $value[0]->jumlah_kriteria_mudah;
                }elseif(isset($value[0]) && $value[0]->kriteria = 2){
                    $sedang = $value[0]->jumlah_kriteria_sedang;
                }elseif(isset($value[0]) && $value[0]->kriteria = 3){
                    $sulit = $value[0]->jumlah_kriteria_sulit;
                }
            // }
            // if(isset($value[1])){
                if(isset($value[1]) && $value[1]->kriteria = 1){
                    $mudah = $value[1]->jumlah_kriteria_mudah;
                }elseif(isset($value[1]) && $value[1]->kriteria = 2){
                    $sedang = $value[1]->jumlah_kriteria_sedang;
                }elseif(isset($value[1]) && $value[1]->kriteria = 3){
                    $sulit = $value[1]->jumlah_kriteria_sulit;
                }
            // }
            // if(isset($value[2])){
                if( isset($value[2]) &&$value[2]->kriteria = 1){
                    $mudah = $value[2]->jumlah_kriteria_mudah;
                }elseif( isset($value[2]) && $value[2]->kriteria = 2){
                    $sedang = $value[2]->jumlah_kriteria_sedang;
                }elseif(isset($value[2]) && $value[2]->kriteria = 3){
                    $sulit = $value[2]->jumlah_kriteria_sulit;
                }
            // } */

            // dd($mudah);

            $komposisi[] = collect([
                'nama_standar_kompetensi' => $value[0]->nama_standar_kompetensi,
                'nama_materi_pokok' => $value[0]->nama_materi_pokok,
                /* 'mudah' => $mudah,
                'sedang' => $sedang,
                'sulit' => $sulit, */

                'mudah' => $value[0]->jumlah_kriteria_mudah,
                'sedang' => isset($value[1])?$value[1]->jumlah_kriteria_sedang:$value[0]->jumlah_kriteria_sedang,
                'sulit' => isset($value[2])?$value[2]->jumlah_kriteria_sulit:$value[0]->jumlah_kriteria_sulit,
            ]);

        }
        // dd($komposisi);

        return view('ppk.kelas.show', ['kelas' => $kelas, 'komposisi' => $komposisi]);
    }

}
