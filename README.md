# Catatan Agenda

Aplikasi pencatatan dan manajemen agenda kegiatan berbasis web. Dibangun dengan **Laravel 9** dan **AdminLTE 3** sebagai template antarmuka, ditujukan untuk pengelolaan agenda pegawai di lingkungan instansi (KSOP).

## Fitur

- **Autentikasi** — login menggunakan username, email, atau NIP (controller login custom), dengan middleware `islogin` untuk melindungi seluruh area aplikasi.
- **Dashboard** — ringkasan agenda beserta statistik jumlah agenda selesai / belum selesai.
- **Agenda Kegiatan** — CRUD lengkap (tambah, ubah, lihat detail, hapus), penandaan status *selesai*, penugasan pegawai ke agenda, dan kalender (FullCalendar).
- **Laporan PDF** — ekspor agenda ke PDF menggunakan `barryvdh/laravel-dompdf`.
- **Bagikan via WhatsApp** — kirim detail agenda langsung ke WhatsApp.
- **Profil** — ubah foto profil, data profil, dan password.
- **Manajemen Pegawai** — CRUD data pegawai.
- **Manajemen Instansi** — CRUD data instansi terkait agenda.
- **Manajemen User** — CRUD user beserta role.
- **Notifikasi** — alert interaktif dengan `realrashid/sweet-alert`.
- **Lokalisasi** — teks aplikasi dalam Bahasa Indonesia (`laravel-lang/lang`).

## Teknologi

| Komponen | Keterangan |
|---|---|
| Laravel 9 | Framework backend (PHP ^8.0) |
| AdminLTE 3 | Template UI (di-serve dari `public/template` via `asset('template')`) |
| MySQL | Database |
| Laravel Mix + Vite | Build asset (CSS/JS) |
| DomPDF | Generate laporan PDF |
| FullCalendar | Tampilan kalender agenda |
| SweetAlert 2 | Notifikasi/alert |

## Persyaratan

- PHP >= 8.0 dengan ekstensi `pdo_mysql`, `mbstring`, `gd` (untuk DomPDF)
- Composer
- Node.js & npm
- MySQL / MariaDB

## Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/mberry87/catatanAgenda.git
cd catatanAgenda

# 2. Install dependensi
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Sesuaikan koneksi database di file .env
#    DB_DATABASE, DB_USERNAME, DB_PASSWORD

# 5. Migrasi dan isi data awal (user & pegawai contoh)
php artisan migrate --seed

# 6. Link storage (untuk foto profil)
php artisan storage:link

# 7. Build aset frontend
npm run build

# 8. Jalankan aplikasi
php artisan serve
```

Buka aplikasi di `http://localhost:8000`.

## Akun Default

Setelah menjalankan `php artisan migrate --seed`, login dapat menggunakan akun berikut:

| Username | Password | Role |
|---|---|---|
| `admin` | `password` | admin |
| `budi` | `password` | admin |
| `siti` | `password` | admin |

> Ganti password akun default sebelum digunakan di lingkungan produksi.

## Struktur Utama

```
app/Http/Controllers/
├── AgendaKegiatanController.php   # CRUD agenda, status, PDF, WhatsApp
├── DashboardCotroller.php         # Halaman dashboard
├── PegawaiController.php          # CRUD pegawai
├── InstansiController.php         # CRUD instansi
├── UserController.php             # CRUD user
└── Auth/LoginController.php       # Login custom (username / email / NIP)

resources/views/
├── backend/                       # Halaman aplikasi (agenda, dashboard, dst.)
└── layouts/admin.blade.php        # Layout utama AdminLTE
```

## Catatan Pengembangan

- Template AdminLTE diambil dari `public/template`, dipakai di view melalui `asset('template/...')`.
- Halaman login dapat diakses langsung; semua route lain dilindungi middleware `islogin`.
- Untuk verifikasi perubahan view: `npm run build` lalu cek render halaman (mis. via `php artisan tinker`).
