<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('gol')->nullable()->change();
            $table->string('jabatan')->nullable()->after('gol');
            $table->string('unit_kerja')->nullable()->after('jabatan');
            $table->string('status')->nullable()->after('unit_kerja');
        });
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->dropColumn(['jabatan', 'unit_kerja', 'status']);
        });
    }
};
