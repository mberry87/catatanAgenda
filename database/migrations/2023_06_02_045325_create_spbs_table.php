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
            $table->string('call_sign');
            $table->string('bendera');
            $table->string('tipe_kapal');
            $table->string('perusahaan');
            $table->foreign('kapal_id')
                ->references('id')
                ->on('kapal')
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
