<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalPilihanGandasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_pilihan_gandas', function (Blueprint $table) {
            $table->id();
            $table->longText('soal');
            $table->longText('pil_a');
            $table->longText('pil_b');
            $table->longText('pil_c');
            $table->longText('pil_d');
            $table->longText('pil_e');
            $table->string('kunci', 1);
            $table->string('status', 1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_pilihan_gandas');
    }
}
