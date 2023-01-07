<?php

namespace App\Http\Controllers;

use App\Imports\PpkImport;
use App\Models\pesertaTesPpk;
use Illuminate\Http\Request;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Exceptions\InvalidOrderException;
use stdClass;
use Throwable;

use function PHPUnit\Framework\isNull;

class CalonPesertaTesPpkController extends Controller {

    public function __construct()
    {
        $this->middleware(['auth','statusAdminCat']);
    }


    public function index (Request $request) {

        $peserta = User::where('tipe','peserta')->where('posisi','ppk')->get();
        if ($request->ajax()){
            return datatables()->of($peserta)
                    ->addColumn('action',function($data){
                        if (count($data->pesertaUjianTesPpk) == 0) {
                            $button = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>';
                        } else {
                            $button ='';
                        }
                        return $button;
                    })
                    ->addColumn('HapusSesi',function($data){
                        $button = '<button type="button" name="" id="'.$data->id.'" class="HapusSesi btn btn-warning btn-sm"><i class="far fa-trash-alt"></i></button>';
                    return $button;
                })

                    ->rawColumns(['action','HapusSesi'])
                    ->addIndexColumn()
                    // ->escapeColumns([])
                    ->make(true);
        }
        return view('ppk.calonPesertaTesPpk.index');
    }


    public function create() {

        return view('ppk.calonPesertaTesPpk.create');
    }

    public function store(Request $request) {

        $validasi = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required'],
            'nip' => ['required','unique:users'],
            'jk' => ['required'],
            'wilayah' => ['required'],
            'kelurahan' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'nik.required' => 'Kolom NIK Tidak Boleh Kosong',
            'nik.unique' => 'NIK Sudah Terdaftar',
            'nip.required' => 'Kolom No Pendafraran Tidak Boleh Kosong',
            'nip.unique' => 'No Pendafraran Sudah Terdaftar',
            'jk.required' => 'Kolom Jenis Kelamin Tidak Boleh Kosong',
            'wilayah.required' => 'Kolom Wilayah Tidak Boleh Kosong',
            'kelurahan.required' => 'Kolom Kelurahan Tidak Boleh Kosong',
            'email.required' => 'Kolom Email Tidak Boleh Kosong',
            'email.email' => 'Kolom Teks Harus Format Email',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Kolom Password Tidak Boleh Kosong',
            'password_confirmation.required' => 'Kolom Konfirmasi Password Tidak Boleh Kosong',
        ]);


        if ($validasi) {
            $peserta = new User;
            $peserta->nik = $request->nik;
            $peserta->name = $request->name;
            $peserta->nip = $request->nip;
            if ($request->jk == 'L') {
                $peserta->jk = 'Laki-laki';
            }
            if ($request->jk == 'P') {
                $peserta->jk = 'Perempuan';
            }
            $peserta->tipe = 'peserta';
            $peserta->posisi = 'ppk';
            $peserta->status = 1;
            $peserta->wilayah = $request->wilayah;
            $peserta->kelurahan = $request->kelurahan;
            $peserta->email = $request->email;
            $peserta->password = Hash::make($request->password);
            $peserta->save();
            return redirect()->route('calon.Peserta.Tes.Ppk.Index');
        }
        else {
            return redirect()->back();
        }
    }

    public function edit($id) {

        $calonPeserta = User::find($id);
        return view('ppk.calonPesertaTesPpk.edit',[
            'calonPeserta' => $calonPeserta
        ]);
    }


    public function destroy($id) {

        $pesertaTesPpk = pesertaTesPpk::where('id_user',$id)->first();
        if (is_null($pesertaTesPpk)) {
            $user = User::find($id);
            $user->delete();
        }
        $peserta = User::where('tipe','peserta')->where('posisi','ppk')->get();
        return response()->json($peserta);
    }

    public function importCalonPesertaPpk(Request $request) {

        $file = request()->file('file');

        // $rows = Excel::toArray(new PpkImport, $request->file('file'));

        // echo"<pre>";
        // print_r($rows);exit;
        // echo"</pre>";

        $import = new PpkImport();
        $import->import($request->file('file'));


        if($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        }
        return redirect()->route('calon.Peserta.Tes.Ppk.Index')->with('success','Data Berhasil di Import');
    }

    function hapusSesi(Request $request) {

                try {
                    $datases = DB::table('sessions')
                    ->where('user_id', $request->user_id)
                    ->delete();
                    $data = new stdClass;
                    if($datases) {
                        // $datases->user_id = null;
                        // $datases->save();
                        // $data->session = $datases;
                        $data->user_id = $request->user_id;
                        $data->title = 'Berhasil';
                        $data->message = 'Session Berhasil dihapus';
                        // return redirect()->route('calon.Peserta.Tes.Ppk.Index');
                        // return json_encode($data);
                        return $data;
                    } else {
                        $data->title = 'Gagal';
                        $data->message = 'Peserta Sedang tidak Log in';
                        // return json_encode($data);
                        return $data;
                    }

                } catch (Throwable $e) {
                    return $e->getMessage();
                }

    }
}
