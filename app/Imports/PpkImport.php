<?php

namespace App\Imports;

use App\Models\User;
use App\Imports\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures as ConcernsSkipsFailures;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Validators\Failure;

class PpkImport implements ToModel, WithValidation, WithHeadingRow, SkipsOnFailure {

    use Importable, ConcernsSkipsFailures;

    public function model(array $row) {
        return new User([
            'name' => $row['name'],
            'nik' => $row['nik'],
            'nip' => $row['no_pendaftaran'],
            'wilayah' => $row['wilayah'],
            'kelurahan' => $row['kelurahan'],
            'tipe' => 'peserta',
            'email' => $row['email'],
            'password' => Hash::make($row['nik']),
            'status' => 1,
            'posisi' => 'ppk'
        ]);
    }

    public function rules(): array {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required'],
            'wilayah' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'kelurahan' => ['required'],

        ];
    }

    public function customValidationMessages() {
        return [
            'name.required' => 'Kolom Nama Tidak Boleh Kosong',
            'nik.required' => 'Kolom NIK Tidak Boleh Kosong',
            'wilayah.required' => 'Kolom Wilayah Tidak Boleh Kosong',
            'email.required' => 'Kolom Email Tidak Boleh Kosong',
            'email.email' => 'Kolom Teks Harus Format Email',
            'email.unique' => 'Email Sudah Terdaftar',
            'kelurahan.required' => 'Kolom Wilayah Tidak Boleh Kosong',
        ];
    }

}
