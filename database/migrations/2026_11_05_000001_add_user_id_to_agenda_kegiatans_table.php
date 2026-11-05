<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agenda_kegiatan', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('instansi_id')
                ->constrained('users')
                ->nullOnDelete();
        });

        DB::statement('ALTER TABLE agenda_kegiatan MODIFY nmr_surat VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('UPDATE agenda_kegiatan SET nmr_surat = "" WHERE nmr_surat IS NULL');
        DB::statement('ALTER TABLE agenda_kegiatan MODIFY nmr_surat VARCHAR(255) NOT NULL');

        Schema::table('agenda_kegiatan', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
        });
    }
};
