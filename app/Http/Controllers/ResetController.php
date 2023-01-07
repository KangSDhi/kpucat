<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResetController extends Controller {

    public function reset() {

        // DB::table('hasil_tes_ppks')->truncate();
        // DB::table('soal_pilihan_berganda_ppks')->truncate();

        // DB::table('ujian_tes_ppks')->truncate();
        // DB::table('kelas_tes_ppks')->truncate();
        // DB::table('peserta_tes_ppks')->truncate();
        DB::table('hasil_tes_ppks')->delete();
        DB::table('soal_pilihan_berganda_ppks')->delete();

        DB::table('ujian_tes_ppks')->delete();
        DB::table('kelas_tes_ppks')->delete();
        DB::table('peserta_tes_ppks')->delete();


        DB::table('users')->where('email','!=','admin@cat2024.com')->delete();

            // User::create([
            //     'name' => 'Admin CAT',
            //     'nik' => '12345',
            //     'nip' => '12345',
            //     'wilayah' => '12345',
            //     'tipe' => 'admin',
            //     'email' => 'admin@cat2024.com',
            //     'password' => Hash::make('admin@cat2024.com'),
            //     'status' => 1,
            //     'posisi' => 'asn'
            // ]);

        return redirect()->route('home');
    }

    public function formResetPasswordAdmin()
    {
        $admin = User::where('posisi', 'asn')->where('id', Auth::id())->first();

        return view('profil.resetpasswordadmin');
    }

    public function resetPasswordAdmin(Request $request, User $user)
    {
        $request->validate([
            'password' => 'string|min:8|confirmed',
        ]);


        // $admin = User::where('posisi', 'asn')->where('id', Auth::id())->first();

        // $admin->update(['password' => bcrypt($request->password)]);
        // $this->alert = 'success';
        // session()->flash('message', 'Password Berhasil Diganti');
        // return redirect()->intended();


        $user = User::find(1);
        $user->password = Hash::make($request->password);
        $user->save();
        $this->alert = 'success';
        session()->flash('message', 'Password Berhasil Diganti');
        return redirect()->intended();


    }
}
