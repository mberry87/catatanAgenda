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
        Schema::create('kapal', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('call_sign');
            $table->unsignedBigInteger('bendera_id')->nullable();
            $table->unsignedBigInteger('tipe_kapal_id')->nullable();
            $table->string('gt')->nullable();
            $table->string('dwt')->nullable();
            $table->string('loa')->nullable();
            $table->string('kapasitas');
            $table->unsignedBigInteger('perusahaan_id')->nullable();
            $table->integer('thn_produksi');
            $table->string('tgl_docking')->nullable();
            $table->timestamps();

            $table->foreign('bendera_id')
                ->references('id')
                ->on('bendera')
                ->onDelete('cascade');
            $table->foreign('tipe_kapal_id')
                ->references('id')
                ->on('tipe_kapal')
                ->onDelete('cascade');
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kapal');
    }
};
