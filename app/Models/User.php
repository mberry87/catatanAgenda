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
        'agenda.view'             => 'Lihat Daftar Agenda',
        'agenda.create'           => 'Tambah Agenda Baru',
        'agenda.edit'             => 'Edit & Tandai Selesai Agenda',
        'agenda.delete'           => 'Hapus Agenda',
        'agenda.pdf'              => 'Export Laporan PDF',
        'instansi.manage'         => 'Kelola Data Instansi',
        'pegawai.manage'          => 'Kelola Data Pegawai',
        'user.manage'             => 'Kelola User & Hak Akses',
        'chat.access'             => 'Akses Fitur Chat',
        'chat.delete_message'     => 'Hapus Pesan Chat',
        'chat.clear_conversation' => 'Hapus Seluruh Pesan Chat',
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
        'last_seen_at'      => 'datetime',
    ];

    /**
     * Check whether the user is currently online (active within last 2 minutes).
     */
    public function isOnline(): bool
    {
        return $this->last_seen_at !== null && $this->last_seen_at->gt(now()->subMinutes(2));
    }

    /**
     * Human-readable online/offline status.
     */
    public function lastSeenText(): string
    {
        if ($this->isOnline()) {
            return 'Online';
        }

        if ($this->last_seen_at) {
            return 'Terakhir dilihat ' . $this->last_seen_at->diffForHumans();
        }

        return 'Offline';
    }

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

        return in_array($permission, ['agenda.view', 'agenda.create', 'agenda.edit', 'agenda.pdf', 'chat.access'], true);
    }
}
