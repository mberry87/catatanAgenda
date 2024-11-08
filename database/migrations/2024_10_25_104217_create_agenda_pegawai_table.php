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
        Schema::create('agenda_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agenda_kegiatan_id')
                ->constrained('agenda_kegiatan')
                ->onDelete('cascade');
            $table->foreignId('pegawai_id')
                ->constrained('pegawai')
                ->onDelete('cascade');
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
        Schema::dropIfExists('agenda_pegawai');
    }
};
