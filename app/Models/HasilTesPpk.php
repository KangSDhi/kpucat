<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilTesPpk extends Model {
    use HasFactory;

    // public function KelasTesPpk() {
    //     return $this->hasMany(ujianTesPpk::class,'id_ujian_tes_ppk');
    // }

    public function ujianTesPpk() {
        return $this->belongsTo(ujianTesPpk::class,'id_ujian_tes_ppk');
    }
}
