<?php

namespace App\Http\Controllers;

use App\Models\kelasTesPpk;
use App\Models\pesertaTesPpk;
use App\Models\SoalKonvensional;
use App\Models\soalPilihanBergandaPpk;
use Illuminate\Http\Request;

class SoalKonvensionalController extends Controller
{
    public function index()
    {
        // $soalKonvensional = ;
        $kelas = kelasTesPpk::all();
        
        $kelas_konvensional = SoalKonvensional::query()
        ->orderBy('id_kelas', 'ASC')->groupBy('id_kelas')->get();

        foreach ($kelas_konvensional as $key => $value) {
            $soal_a[$value->id] = json_decode($value->where('paket_soal', 'A')->first()->json_soal);
            $soal_b[$value->id] = json_decode($value->where('paket_soal', 'B')->first()->json_soal);
            $soal_c[$value->id] = json_decode($value->where('paket_soal', 'C')->first()->json_soal);
            $soal_d[$value->id] = json_decode($value->where('paket_soal', 'D')->first()->json_soal);

            $total_soal_a[$value->id] = count($soal_a[$value->id]);
            $total_soal_b[$value->id] = count($soal_b[$value->id]);
            $total_soal_c[$value->id] = count($soal_c[$value->id]);
            $total_soal_d[$value->id] = count($soal_d[$value->id]);
        }

        // dd(count($soal_a[1]));

        return view('ppk.konvensional.index', ['kelasTes' => $kelas, 'soal_kelas_konvensional' => $kelas_konvensional, '']);
    }

    public function create()
    {
        $kelas = kelasTesPpk::all();
        return view('ppk.konvensional.create', ['kelasTes' => $kelas]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|integer',
            // 'kode' => 'required|in:A,B,C,D'
        ]);

        $kelas = kelasTesPpk::find($request->kelas);
        /* $pesertaUjianTesPpk = pesertaTesPpk::where('id', $idPesertaTesPpk)
            ->where('id_kelas', $kelas)
            ->where('id_user', auth()->user()->id)
            ->where('status', 1)
            ->first(); */

            
            
            // dd($encodeJson);
            $kode_soal = ['A', 'B', 'C', 'D'];
            
        foreach ($kode_soal as $idx => $kds) {
            $dataSoalUjian = $this->getRandomSoal($kelas);
            // dd(shuffle($dataSoalUjian));
            $encodeJson = json_encode($dataSoalUjian, JSON_PRETTY_PRINT);
            $data_kelas_konvensional = [
                'id_kelas' => $request->kelas,
                'json_soal' => $encodeJson,
                'paket_soal' => $kds
            ];

            SoalKonvensional::create($data_kelas_konvensional);
        }
        // dd($data_kelas_konvensional);
        // $ujianTesPpk = ujianTesPpk::where('id_peserta', $pesertaUjianTesPpk->id)->where('status', 1)->get();
        // $collection = collect($ujianTesPpk)->pluck('id_peserta');

        /* if (!$collection->contains($pesertaUjianTesPpk->id)) {
            if ($pesertaUjianTesPpk->random_soal == 1) {
                $ujian = new ujianTesPpk;
                $ujian->id_peserta = $pesertaUjianTesPpk->id;
                $ujian->id_kelas = $pesertaUjianTesPpk->id_kelas;
                $ujian->json_soal = $encodeJson;
                $ujian->status = 1;
                $ujian->save();
            }
        } */

        return back();
    }

    public function show($id_kelas)
    {
        $soal_konvensional = SoalKonvensional::where('id_kelas', $id_kelas)->groupBy('id_kelas')->first();

        // dd($soal_konvensional->where('paket_soal', 'C')->first());

        return view('ppk.konvensional.show', ['soal_konvensional' => $soal_konvensional]);

    }

    public function getRandomSoal($kelas)
    {
        $komposisiSoal = json_decode($kelas->json_komposisi_soal_ganda, true);

        foreach ($komposisiSoal as $key => $item) {
            // dd($item);
            if ($item['kriteria'] == '1') {
                $jumlah = intval($item['jumlah_kriteria_mudah']);
            }
            if ($item['kriteria'] == '2') {
                $jumlah = intval($item['jumlah_kriteria_sedang']);
            }
            if ($item['kriteria'] == '3') {
                $jumlah = intval($item['jumlah_kriteria_sulit']);
            }

            $soalGanda = soalPilihanBergandaPpk::query()
                ->where('id_standar_kompetensi', $item['id_standar_kompetensi'])
                ->where('id_materi_pokok', $item['id_materi_pokok'])
                ->where('kriteria', $item['kriteria'])
                ->limit($jumlah)
                ->inRandomOrder()
                ->get();
            

            // dd($soalGanda->shuffle());

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

        $shuffled_dataSoal = collect($dataSoalUjian)->shuffle()->toArray();

        return $shuffled_dataSoal;
    }

    public function printSoal($id)
    {
        $soal = SoalKonvensional::find($id);

        return view('ppk.konvensional.export-soal', ['soal' => $soal]);

        /* foreach(json_decode($soal->json_soal) as $idx => $soal){

        } */
    }



    public function delete($id)
    {
        $kelas = kelasTesPpk::find($id);
        session()->flash('kelas_konvensional', $kelas->nama_kelas);

        $soal = SoalKonvensional::where('id_kelas', $id)->get();
        
        foreach ($soal as $key => $s) {
            $s->delete();
        }

        session()->flash('success', 'Soal Konvensional untuk kelas '.session()->get('kelas_konvensional'). ' telah dihapus.');
        return back();
    }


    public function printLbrJawaban($id)
    {
        $soal = SoalKonvensional::find($id);

        $soal_array = array();
        $soal_json_decoded = json_decode($soal->json_soal);
        // dd($soal_json_decoded);
        $soal_chunked = array_chunk($soal_json_decoded,20);

        return view('ppk.konvensional.export-lembar-jawaban', ['soal' => $soal, 'per_kolom' => $soal_chunked]);

        /* foreach(json_decode($soal->json_soal) as $idx => $soal){

        } */
    }
}
