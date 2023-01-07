<?php

namespace App\Http\Controllers;

use App\Models\kelasTesPpk;
use Illuminate\Http\Request;
use App\Models\pesertaTesPpk;
use App\Models\ujianTesPpk;
use App\Models\User;
use App\Models\HasilTesPpk;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Crypt;





class pesertaTesPpkController extends Controller {

    public function __construct() {
        // $this->middleware(['auth','statusKelasTesPpk','statusAdminCat']);
        $this->middleware(['auth','statusAdminCat']);
    }

    public function index (Request $request) {

        $peserta = pesertaTesPpk::select('id', 'id_kelas','id_user','status','sisa_waktu','created_at','updated_at')->with('kelas','peserta')->get();
        // $peserta = pesertaTesPpk::all();
        if ($request->ajax()){
            return datatables()->of($peserta)
                    ->addColumn('Nama',function($data){
                        $nama = $data->peserta->name;
                        return $nama;
                    })
                    ->addColumn('NIK',function($data){
                        $nik = $data->peserta->nik;
                        return $nik;
                    })
                    ->addColumn('Email',function($data){
                        $email = $data->peserta->email;
                        return $email;
                    })
                    ->addColumn('Kelas',function($data){
                        $kelas = $data->kelas->nama_kelas;
                        return $kelas;
                    })
                    ->addColumn('Aksi',function($data){
                        if (count($data->UjianTes) == 0) {
                            $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                        } else {
                            $button ='';
                        }
                        return $button;
                    })
                    ->rawColumns(['Nama','NIK','Email','Kelas','Aksi'])
                    ->addIndexColumn()
                    // ->escapeColumns([])
                    ->make(true);
        }
        return view('ppk.pesertaTesPpk.index');
    }


    public function create(Request $request) {

        $pesertaTes = pesertaTesPpk::all();
            foreach ($pesertaTes as $key => $item) {
                $idPeserta[$key] = $item->id_user;
            }
        if (count($pesertaTes) == 0) {
            $peserta = User::where('tipe','peserta')->where('posisi','ppk')
            ->OrderBy('name','ASC')
            ->get();
        }
        else {
            $peserta = User::where('tipe','peserta')->where('posisi','ppk')
            ->whereNotIn('id',$idPeserta)
            ->OrderBy('name','ASC')
            ->get();
        }

        $kelasAktif = kelasTesPpk::where('status',1)->OrderBy('nama_kelas','ASC')->get();
        return view('ppk.pesertaTesPpk.create',[
            'peserta' => $peserta,
            'kelasAktif' => $kelasAktif
        ]);
    }


    public function store(Request $request) {

        if ($request->item !== null)  {
            foreach ($request->item as $inputUser) {

                $kelasAktif = pesertaTesPpk::where('id_user',$inputUser)->where('status',1)->get();
                $collection = collect($kelasAktif)->pluck('id_user');

                if (!$collection->contains($inputUser)) {
                $pesertaTesPpk = new pesertaTesPpk();
                    $kelas = kelasTesPpk::find($request->kelas);
                $pesertaTesPpk->id_kelas= $request->kelas;
                $pesertaTesPpk->id_user = $inputUser;
                $pesertaTesPpk->status = 1;
                $pesertaTesPpk->sisa_waktu = $kelas->waktu_pengerjaan * 60 ;
                $pesertaTesPpk->save();

                $calonPeserta = User::find($inputUser);
                $calonPeserta->status = 0;
                $calonPeserta->save();

                } else {
                    return redirect()->route('peserta.Ppk.Tes.Index');
                }

            }
        } else {
            return redirect()->back();
        }
        return redirect()->route('peserta.Ppk.Tes.Index');
    }


    public function hapus($idPeserta) {

        $ujianTesPpk = ujianTesPpk::where('id_peserta',$idPeserta)->first();

        if (is_null($ujianTesPpk)) {
            $peserta = pesertaTesPpk::find($idPeserta);
            $peserta->delete();
        }
        $peserta = pesertaTesPpk::all();
        return response()->json($peserta);
    }

    public function kick(Request $request ) {

        $ujianTesPpk = DB::table('ujian_tes_ppks as ujian')
                    ->join('peserta_tes_ppks as peserta','ujian.id_peserta','=','peserta.id')
                    ->where('peserta.id_user',$request->idpeserta)
                    ->select('peserta.id as id_peserta','peserta.id_user as id_user')
                    ->first();

        if ($ujianTesPpk) {
            $peserta = pesertaTesPpk::find($ujianTesPpk->id_peserta);
            $peserta->status = 0;
            $peserta->save();

            $ujianTesPpk = ujianTesPpk::where('id_peserta',$ujianTesPpk->id_peserta)->first();
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

            return back();
        }
        else {
            return back();
        }
    }

}
