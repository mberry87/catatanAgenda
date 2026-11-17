<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const AVAILABLE_PERMISSIONS = [
        'agenda.view'     => 'Lihat Daftar Agenda',
        'agenda.create'   => 'Tambah Agenda Baru',
        'agenda.edit'     => 'Edit & Tandai Selesai Agenda',
        'agenda.delete'   => 'Hapus Agenda',
        'agenda.pdf'      => 'Export Laporan PDF',
        'instansi.manage' => 'Kelola Data Instansi',
        'pegawai.manage'  => 'Kelola Data Pegawai',
        'user.manage'     => 'Kelola User & Hak Akses',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'agama',
        'nip',
        'tgl_lahir',
        'tmp_lahir',
        'alamat',
        'telepon',
        'photo_profil',
        'role',
        'permissions',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'permissions'       => 'array',
    ];

    /**
     * Check whether the user has a given permission.
     */
    public function hasPermission(string $permission): bool
    {
        if (is_array($this->permissions)) {
            return in_array($permission, $this->permissions, true);
        }

        // Backward compatibility for existing users before permissions were configured
        if (in_array($this->role, ['admin', 'superadmin'], true)) {
            return true;
        }

        return in_array($permission, ['agenda.view', 'agenda.create', 'agenda.edit', 'agenda.pdf'], true);
    }
}
