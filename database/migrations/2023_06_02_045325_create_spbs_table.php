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
        Schema::create('spb', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kapal_id')->nullable();
            $table->string('pemohon');
            $table->string('no_surat');
            $table->string('tgl_surat');
            $table->string('no_regis');
            $table->string('bendera');
            $table->string('tipe_kapal');
            $table->string('gt');
            $table->string('call_sign');
            $table->string('perusahaan');
            $table->unsignedBigInteger('pelabuhan_id')->nullable();
            $table->unsignedBigInteger('pegawai_id')->nullable();
            $table->foreign('kapal_id')
                ->references('id')
                ->on('kapal')
                ->onDelete('cascade');
            $table->foreign('pelabuhan_id')
                ->references('id')
                ->on('pelabuhan')
                ->onDelete('cascade');
            $table->foreign('pegawai_id')
                ->references('id')
                ->on('pegawai')
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
        Schema::dropIfExists('spb');
    }
};
