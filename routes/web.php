<?php

use App\Http\Controllers\CalonPesertaController;
use App\Http\Controllers\CalonPesertaTesPpkController;
use App\Http\Controllers\HasilAssessmentController;
use App\Http\Controllers\HasilTesPpkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriSoalController;
use App\Http\Controllers\SoalPilihanGandaController;
use App\Http\Controllers\KategoriUjianController;
use App\Http\Controllers\KelasTesPpkController;
use App\Http\Controllers\KelasUjianController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\MateriPokokController;
use App\Http\Controllers\PengawasUjianController;
use App\Http\Controllers\pesertaTesPpkController;
use App\Http\Controllers\PesertaTesPpkControlller;
use App\Http\Controllers\PesertaUjianController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SoalBenarSalahController;
use App\Http\Controllers\SoalEssaiController;
use App\Http\Controllers\SoalKonvensionalController;
use App\Http\Controllers\SoalModelSkalaController;
use App\Http\Controllers\SoalPilihanBergandaPpkController;
use App\Http\Controllers\SoalSebabAkibatController;
use App\Http\Controllers\StandarKomptensiController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\UjianTesPpkController;
use App\Http\Controllers\UjiCobaController;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Gd\Commands\RotateCommand;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route Khusu Package File Manager
// Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
//     \UniSharp\LaravelFilemanager\Lfm::routes();
// });


Route::get('/', function () {
    return view('welcomeAdminlte');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Pelaksanaan Ujian PPK
Route::get('/ppk/rekrutmen/{idPesertaUjian}/{idKelas}',[UjianTesPpkController::class,'ambilData'])->name('ujian.Ppk.AmbilData');
Route::get('/ppk/rekrutmen/selanjutnya/{idPesertaUjian}/{arraytIdSelanjutnya}/{durasi}',[UjianTesPpkController::class,'simpanJawabanSelanjutnya'])->name('simpan.Jawaban.Selanjutnya.Tes.Ppk');
Route::post('/ppk/rekrutmen/simpan',[UjianTesPpkController::class,'simpanJawaban'])->name('simpan.Jawaban.Tes.Ppk');
Route::get('/ppk/rekrutmen/selesai/tes/{idUjianTesPpk}',[UjianTesPpkController::class,'selesaiRekrutmenPpk'])->name('selesai.Tes.Rekrutmen.Ppk');

Route::get('/ppk/rekrutmen/selesai/tes/submit/{idUjianTesPpk}',[UjianTesPpkController::class,'sumbitSelesaiRekrutmenPpk'])->name('selesai.Tes.Rekrutmen.Ppk.Submit');
Route::get('/ppk/rekrutmen/durasi/{idPesertaUjian}/{durasi}',[UjianTesPpkController::class,'ambilDurasi'])->name('ambil.Durasi');


// Halaman Admin
Route::prefix('/admin/cat')->group(function() {

    # Halaman PPK
    #--------------------------------
    Route::get('/home/ppk',[HomeController::class,'ppkIndex'])->name('home.Ppk');

    # Route Calon Peserta PPK
    Route::get('/ppk/calon/peserta/tes',[CalonPesertaTesPpkController::class,'index'])->name('calon.Peserta.Tes.Ppk.Index');
    Route::post('/ppk/calon/peserta/tes/import',[CalonPesertaTesPpkController::class,'importCalonPesertaPpk'])->name('calon.Peserta.Tes.Ppk.Import');
    Route::get('/ppk/calon/peserta/tes/ppk/tambah',[CalonPesertaTesPpkController::class,'create'])->name('calon.Peserta.Tes.Ppk.Tambah');
    Route::post('/ppk/calon/peserta/tes/ppk/tambah/simpan',[CalonPesertaTesPpkController::class,'store'])->name('calon.Peserta.Tes.Ppk.Tambah.Simpan');
    Route::get('/ppk/calon/peserta/tes/ppk/ubah/{$idCalonPeserta}',[CalonPesertaTesPpkController::class,'edit'])->name('calon.Peserta.Tes.Ppk.Edit');
    Route::post('/ppk/calon/peserta/tes/ppk/edit/simpan/{idCalonPeserta}',[CalonPesertaTesPpkController::class,'update'])->name('calon.Peserta.Tes.Ppk.Edit.Simpan');
    Route::delete('/ppk/calon/peserta/tes/ppk/hapus/{idCalonPeserta}',[CalonPesertaTesPpkController::class,'destroy'])->name('calon.Peserta.Tes.Ppk.Hapus');
    Route::post('/ppk/calon/peserta/tes/ppk/hapusSesi',[CalonPesertaTesPpkController::class,'hapusSesi'])->name('calon.Peserta.Tes.Ppk.HapusSesi');

    # Route standar kompetensi
    Route::get('/ppk/standar/komptensi',[StandarKomptensiController::class,'index'])->name('standar.Kompetensi.Index');
    # Route materi pokok
    // Route::get('/ppk/materi/pokok',[MateriPokokController::class,'index'])->name('materi.Pokok.Index');

    # Route soal pilihan Berganda PPK
    Route::get('/ppk/soal/pilihan/berganda',[SoalPilihanBergandaPpkController::class,'index'])->name('soal.Pilihan.Berganda.Index');
    Route::post('/ppk/import/pilihanGanda',[SoalPilihanBergandaPpkController::class,'importPilihanGanda'])->name('import.Pilihan.Berganda.Index');

    # Route kelas tes ppk
    Route::get('/ppk/kelas',[KelasTesPpkController::class,'index'])->name('kelas.Ppk.Tes.Index');
    Route::get('/ppk/kelas/tambah',[KelasTesPpkController::class,'create'])->name('kelas.Ppk.Tes.Create');
    Route::post('/ppk/kelas/tambah/simpan',[KelasTesPpkController::class,'store'])->name('kelas.Ppk.Tes.Store');
    Route::get('/ppk/kelas/detail/{idKelas}',[KelasTesPpkController::class,'show'])->name('kelas.Tes.Ppk.Show');
    Route::post('/ppk/kelas/deaktivasi/{idKelas}',[KelasTesPpkController::class,'deaktivasi'])->name('kelas.Ppk.Tes.Deaktivasi');
    // Route::post('/ppk/kelas/ubah/simpan/{idKelas}',[KelasTesPpkController::class,'update'])->name('kelas.Ppk.Tes.Update');
    Route::get('/ppk/kelas/hapus/{idKelas}',[KelasTesPpkController::class,'destroy'])->name('kelas.Ppk.Tes.Destroy');
    Route::get('/ppk/kelas/export/{idKelas}',[KelasTesPpkController::class,'export'])->name('kelas.Tes.Ppk.Export');

    # Generate Soal
    Route::get('/ppk/kelas/generate/soal/{idKelas}',[KelasTesPpkController::class,'generateSoal'])->name('kelas.Tes.generate.Soal');

    # Route Tes Konvensional
    Route::get('ppk/kelas/konvensional', [SoalKonvensionalController::class, 'index'])->name('ppk.kelas-konvensional.index');
    Route::get('ppk/kelas/konvensional/create', [SoalKonvensionalController::class, 'create'])->name('ppk.kelas-konvensional.create');
    Route::post('ppk/kelas/konvensional', [SoalKonvensionalController::class, 'store'])->name('ppk.kelas-konvensional.store');
    Route::get('ppk/kelas/konvensional/show/{idKelas}', [SoalKonvensionalController::class, 'show'])->name('ppk.kelas-konvensional.show');
    Route::get('ppk/kelas/konvensional/cetak_soal/{id}', [SoalKonvensionalController::class, 'printSoal'])->name('ppk.kelas-konvensional.print_soal');
    Route::delete('ppk/kelas/konvensional/{idKelas}/delete', [SoalKonvensionalController::class, 'delete'])->name('ppk.kelas-konvensional.delete');

    Route::get('ppk/kelas/konvensional/cetak_lbr_jawaban/{id}', [SoalKonvensionalController::class, 'printLbrJawaban'])->name('ppk.kelas-konvensional.print_lbr_jawaban');




    # Route peserta tes ppk
    Route::get('/ppk/peserta',[pesertaTesPpkController::class,'index'])->name('peserta.Ppk.Tes.Index');
    Route::get('/ppk/peserta/tambah',[pesertaTesPpkController::class,'create'])->name('peserta.Ppk.Tes.Create');
    Route::post('/ppk/peserta/tambah/simpan',[pesertaTesPpkController::class,'store'])->name('peserta.Ppk.Tes.Store');
    Route::delete('/ppk/peserta/hapus/{idPeserta}',[pesertaTesPpkController::class,'hapus'])->name('peserta.Ppk.Tes.Hapus');
    Route::post('/ppk/peserta/kick',[pesertaTesPpkController::class,'kick'])->name('peserta.Ppk.Tes.Kick');


    Route::get('/ppk/hasil',[HasilTesPpkController::class,'index'])->name('hasil.Tes.Ppk.Index');
    Route::post('/ppk/hasil/export/pengumuman', [HasilTesPpkController::class, 'exportPengumuman'])->name('hasil.Tes.Ppk.Export.Pengumuman');
    Route::get('/hasil/get/wilayah/{kelas}',[HasilTesPpkController::class,'getWilayah'])->name('get.Wilayah');

    // Reset
    Route::get('/ppk/reset',[ResetController::class,'reset'])->name('reset');

    // Route::get('/user/log',[LogController::class,'index'])->name('log.Controller.Index');

    Route::get('profil/resetpassword', [ResetController::class, 'formResetPasswordAdmin'])->name('resetpassword.admin');
    Route::post('profil/resetpassword', [ResetController::class, 'resetPasswordAdmin'])->name('do_resetpassword.admin');


});
