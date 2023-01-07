<?php

namespace App\Http\Controllers;

use App\Models\HasilTesPpk;
use App\Models\kelasTesPpk;
use App\Models\pesertaTesPpk;
use App\Models\soalPilihanBergandaPpk;
use App\Models\Ujian;
use App\Models\ujianTesPpk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Redirect;

class UjianTesPpkController extends Controller {

    public function __construct() {
        // $this->middleware(['auth','StatusPesertaUjianPpk','statusKelasTesPpk']);
        $this->middleware(['auth','StatusPesertaUjianPpk']);
    }

    public function ambilData($idPesertaTesPpk,$idKelasTesPpk) {



        $kelasUjianTesPpk = kelasTesPpk::find($idKelasTesPpk);
        $pesertaTesPpk = pesertaTesPpk::find($idPesertaTesPpk);
        $komposisiSoal = json_decode($kelasUjianTesPpk->json_komposisi_soal_ganda,true);

        foreach ($komposisiSoal as $key => $item) {

            if ($item['kriteria'] == '1') {
                $jumlah = intval($item['jumlah_kriteria_mudah']);
            }
            if ($item['kriteria'] == '2') {
                $jumlah = intval($item['jumlah_kriteria_sedang']);
            }
            if ($item['kriteria'] == '3') {
                $jumlah = intval($item['jumlah_kriteria_sulit']);
            }

            $soalGanda = soalPilihanBergandaPpk::inRandomOrder()
                        ->where('id_standar_kompetensi',$item['id_standar_kompetensi'])
                        ->where('id_materi_pokok',$item['id_materi_pokok'])
                        ->where('kriteria',$item['kriteria'])
                        ->limit($jumlah)
                        ->get();

            foreach ($soalGanda as $item) {
                            $dataSoalUjian[] = array(
                                        'id_soal' => $item['id'],
                                        'soal' => $item['soal'],
                                        'pil_a' => $item['pil_a'],
                                        'pil_b' => $item['pil_b'],
                                        'pil_c' => $item['pil_c'],
                                        'pil_d' => $item['pil_d'],
                                        'kunci' => $item['kunci'],
                                        'nilai_benar' => $item['nilai_benar'],
                                        'nilai_salah' => $item['nilai_salah'],
                                        'kriteria' => $item['kriteria'],
                                        'jawaban_pilihan_ganda' => null,
                                        'cek_jawaban' => null
                            );
                        }
        }

        $encodeJson = json_encode($dataSoalUjian,JSON_PRETTY_PRINT);
        $ujianTesPpk = ujianTesPpk::where('id_peserta',$idPesertaTesPpk)->where('status',1)->get();
        $collection = collect($ujianTesPpk)->pluck('id_peserta');

        if (!$collection->contains($idPesertaTesPpk)) {
                $ujian = new ujianTesPpk;
                $ujian->id_peserta = $idPesertaTesPpk;
                $ujian->id_kelas = $pesertaTesPpk->id_kelas;
                $ujian->json_soal = $encodeJson;
                $ujian->status = 1;
                $ujian->save();
        }

        return view('ppkHalamanUjian.infoAwal',[
            'kelasUjianTesPpk' => $kelasUjianTesPpk,
            'pesertaUjianTesPpk' =>$pesertaTesPpk,
            'IndexSoalUjian' => 0,
            'durasi' => $pesertaTesPpk->sisa_waktu
        ]);
    }

    public function simpanJawabanSelanjutnya($idPesertaUjian,$noUrutIDsoalUjian,$durasi) {

        $pesertaUjian = pesertaTesPpk::where('id',$idPesertaUjian)->first();
        $pesertaUjian->update(['sisa_waktu'=> $durasi]);

        $dataJson = ujianTesPpk::where('id_peserta',$idPesertaUjian)
                        ->where('status',1)
                        ->first();
        if(!empty($dataJson)){
        $ujianSoal = json_decode($dataJson->json_soal,true);
        $noUrutId = $noUrutIDsoalUjian;
            return view('ppkHalamanUjian.ujianFormUpdateSelanjutnya',[
                'jumlahSoalPilihanGanda' => count($ujianSoal),
                'idUjianTesPpk'=> $dataJson->id,
                'kelas' => $dataJson->id_kelas,
                'soalUjian' => $ujianSoal,
                'idPesertaUjian' => $idPesertaUjian,
                'noUrutId' => $noUrutId,
                // 'waktu_selesai' => $pesertaUjian->waktu_selesai,
                'sisaWaktu' => $pesertaUjian->sisa_waktu
            ]);
        }else{
            abort(404);
        }
    }

    public function simpanJawaban (Request $request) {

        $pesertaTesPpk = pesertaTesPpk::find($request->id_peserta);
        $pesertaTesPpk->update(['sisa_waktu' => $request->durasi]);

        $dataJson = ujianTesPpk::where('id_peserta',$request->id_peserta)
                    ->where('status',1)
                    ->first();
        if(!empty($dataJson)){
            $ujianSoal = json_decode ($dataJson->json_soal,true);
            $id = $dataJson->id;

            if (!empty($request->jawaban)) {
                foreach ($ujianSoal as $key => $item) {
                    if (($item['id_soal']) == intval($request->id_soal)) {
                        $ujianSoal[$key]['jawaban_pilihan_ganda'] = $request->jawaban;

                        if ($item['kunci'] == $request->jawaban) {
                            $ujianSoal[$key]['cek_jawaban'] = $item['nilai_benar'];
                        } else {
                            $ujianSoal[$key]['cek_jawaban'] = 0;
                        }
                    }

                    $ujian = ujianTesPpk::find($id);
                    $ujian->json_soal = json_encode($ujianSoal,JSON_PRETTY_PRINT);
                    $ujian->save();
                }

            }
            return redirect()->route('simpan.Jawaban.Selanjutnya.Tes.Ppk', [$request->id_peserta, $request->no_urut,  $request->durasi]);

        }else{
            abort(404);
        }
    }


    public function selesaiRekrutmenPpk($idPesertaUjianTesPpk) {

        $userLastSeen = auth()->user()->last_seen;
        $waktuUserLastSeen = date_create($userLastSeen);
        $sekarang = date_create();
        $diff  = date_diff( $waktuUserLastSeen, $sekarang );

        if ($diff->i <= 1) {

            $ujianTesPpk = ujianTesPpk::where('id_peserta',$idPesertaUjianTesPpk)->first();
            $komposisiSoal = json_decode($ujianTesPpk->json_soal,true);

            $total = 0;
            foreach ($komposisiSoal as $item) {
                $jumlah = intval($item['cek_jawaban']) ;
                $total = $total + $jumlah;
            }

            if ($ujianTesPpk->status == 1) {
                $hasilTesppk = new HasilTesPpk;
                $hasilTesppk->id_peserta_tes_ppk = $ujianTesPpk->id_peserta;
                $hasilTesppk->nik = $ujianTesPpk->pesertaTesPpk->peserta->nik;
                $hasilTesppk->nama = $ujianTesPpk->pesertaTesPpk->peserta->name;
                $hasilTesppk->kelas = $ujianTesPpk->kelasTesPpk->nama_kelas;
                $hasilTesppk->no_pendaftaran = $ujianTesPpk->pesertaTesPpk->peserta->nip;
                $hasilTesppk->wilayah = $ujianTesPpk->pesertaTesPpk->peserta->wilayah;
                $hasilTesppk->kelurahan = $ujianTesPpk->pesertaTesPpk->peserta->kelurahan;
                $hasilTesppk->total_nilai = Crypt::encryptString($total);
                $hasilTesppk->save();

            $ujianTesPpk->status = 0;
            $ujianTesPpk->save();
            }

            $pesertaTesPpk = pesertaTesPpk::find($ujianTesPpk->id_peserta);
            $pesertaTesPpk->status = 0;
            $pesertaTesPpk->save();

            $tampilHasil = HasilTesPpk::where('id_peserta_tes_ppk',$idPesertaUjianTesPpk)->first();
            return view('ppkHalamanUjian.infoAkhir',[
                'hasilTesppk' => $tampilHasil
            ]);

        } else {

          //return redirect()->route('home');
          return Redirect::to(url()->previous());


        }
    }


    public function sumbitSelesaiRekrutmenPpk($idPesertaUjianTesPpk) {

        $ujianTesPpk = ujianTesPpk::where('id_peserta',$idPesertaUjianTesPpk)->first();
        $komposisiSoal = json_decode($ujianTesPpk->json_soal,true);

        $total = 0;
        foreach ($komposisiSoal as $item) {
            $jumlah = intval($item['cek_jawaban']) ;
            $total = $total + $jumlah;
        }

        if ($ujianTesPpk->status == 1) {
            $hasilTesppk = new HasilTesPpk;
            $hasilTesppk->id_peserta_tes_ppk = $ujianTesPpk->id_peserta;
            $hasilTesppk->nik = $ujianTesPpk->pesertaTesPpk->peserta->nik;
            $hasilTesppk->nama = $ujianTesPpk->pesertaTesPpk->peserta->name;
            $hasilTesppk->kelas = $ujianTesPpk->kelasTesPpk->nama_kelas;
            $hasilTesppk->no_pendaftaran = $ujianTesPpk->pesertaTesPpk->peserta->nip;
            $hasilTesppk->wilayah = $ujianTesPpk->pesertaTesPpk->peserta->wilayah;
            $hasilTesppk->kelurahan = $ujianTesPpk->pesertaTesPpk->peserta->kelurahan;
            $hasilTesppk->total_nilai = Crypt::encryptString($total);
            $hasilTesppk->save();

        $ujianTesPpk->status = 0;
        $ujianTesPpk->save();
        }

        $pesertaTesPpk = pesertaTesPpk::find($ujianTesPpk->id_peserta);
        $pesertaTesPpk->status = 0;
        $pesertaTesPpk->save();

        $tampilHasil = HasilTesPpk::where('id_peserta_tes_ppk',$idPesertaUjianTesPpk)->first();
        return view('ppkHalamanUjian.infoAkhir',[
            'hasilTesppk' => $tampilHasil
        ]);
    }

    public function ambilDurasi($idPesertaUjian,$durasi) {
        $pesertaTesPpk = pesertaTesPpk::find($idPesertaUjian);
        $pesertaTesPpk->sisa_waktu = $durasi;
        $pesertaTesPpk->save();
        return redirect()->back();
    }
}
