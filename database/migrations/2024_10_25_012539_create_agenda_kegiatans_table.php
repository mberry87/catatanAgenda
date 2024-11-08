<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nmr_surat');
            $table->text('uraian');
            $table->string('tgl_mulai');
            $table->string('tgl_selesai');
            $table->string('pakaian');
            $table->string('pukul');
            $table->string('tempat');
            $table->foreignId('instansi_id')
                ->constrained('instansi')
                ->onDelete('cascade');
            $table->string('jenis_agenda');
            $table->string('status');
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('agenda_kegiatan');
    }
};
