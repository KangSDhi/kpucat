<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Models\kategoriUjian;
use App\Models\kelasTesPpk;
use App\Models\User;
use App\Models\pesertaUjian;
use App\Models\kelasUjian;
use App\Models\materiPokok;
use App\Models\pesertaTesPpk;
use App\Models\soalPilihanBergandaPpk;
use App\Models\soalPilihanGanda;
use PhpParser\Node\Stmt\Echo_;

class HomeController extends Controller {

    public function __construct() {
        $this->middleware(['auth','statusKelasTesPpk']);
    }

    public function index() {

        if (auth()->user()->tipe == 'admin') {

            $calonPeserta = User::where('tipe','peserta')->where('posisi','ppk')->get('id');
            $totalSoal = soalPilihanBergandaPpk::get('id');
            $totalKelas = kelasTesPpk::get('id');
            $totalPeserta = pesertaTesPpk::get('id');
            return view('ppk.home',[
                'calonPeserta' => count($calonPeserta),
                'totalSoal' => count($totalSoal),
                'totalKelas' => count($totalKelas),
                'totalPeserta' => count($totalPeserta)
            ]);
        }

        elseif ((auth()->user()->tipe == 'peserta') && (auth()->user()->posisi == 'ppk')) {

            # cek apakakah User terdapat dalam tabel Peserta Ujian
            $cekPesertaUjian = pesertaTesPpk::where('id_user',auth()->user()->id)
                                ->where('status',1)->first();

            if (!is_null($cekPesertaUjian) ) {
                if (!is_null($cekPesertaUjian->kelas)) {
                    if (!is_null($cekPesertaUjian->kelas->status)) {
                        if ($cekPesertaUjian->kelas->status == 1) {
                            if($cekPesertaUjian->status == 1) {
                                return view('ppkHalamanUjian.home',[
                                            'cekPesertaUjian' => $cekPesertaUjian
                                            ]);
                                } else {
                                    return view('ppkHalamanUjian.homeNotUjian');
                                }
                        } else {
                            return view('ppkHalamanUjian.homeNotUjian');
                        }
                    } else {
                        return view('ppkHalamanUjian.homeNotUjian');
                    }
                } else {
                    return view('ppkHalamanUjian.homeNotUjian');
                }
            } else {
                return view('ppkHalamanUjian.homeNotUjian');
            }
        }
    }

}
