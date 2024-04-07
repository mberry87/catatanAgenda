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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('kapal_id')
                ->references('id')
                ->on('kapal')
                ->onDelete('cascade');
            $table->foreign('pelabuhan_id')
                ->references('id')
                ->on('pelabuhan')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->string('no_imo');
            $table->string('thn_produksi');
            $table->string('nakhoda');
            $table->string('tgl_nakhoda');
            $table->string('jam_nakhoda');
            $table->string('bertolak');
            $table->string('tgl_bertolak');
            $table->string('jam_bertolak');
            $table->string('jml_crew');
            $table->string('muatan');
            $table->string('tmp_terbit');
            $table->string('tgl_terbit');
            $table->string('jam_terbit');
            $table->string('no_pup');
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
