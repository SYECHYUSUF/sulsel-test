Struktur Halaman Admin PPID

1. Dashboard Utama
   Ringkasan Statistik: Menampilkan jumlah kunjungan (visitors), total permohonan informasi, berita aktif, dan status pengajuan keberatan.

Grafik Kunjungan: Visualisasi data dari tabel kunjungan.

Log Aktivitas: Daftar login terakhir dari tabel log_login.

2. Layanan Informasi Publik

Permohonan Informasi: Manajemen data dari tbl_permohonan_informasi (Verifikasi, proses, dan pemberian file jawaban).

Pengajuan Keberatan: Manajemen data dari tbl_pengajuan dan tbl_alasan_pengajuan untuk pemohon yang mengajukan keberatan atas layanan.

Log Permohonan: Riwayat perubahan status permohonan.

3. Manajemen Informasi & Dokumen

Daftar Informasi Publik (DIP): Pengaturan kategori utama informasi melalui ms_daftar_informasi_publik.

Data Informasi: Kelola detail isi informasi publik pada daftar_informasi_publik.

Kategori Informasi: Manajemen kategori (Berkala, Serta Merta, Setiap Saat) menggunakan tbl_kat_informasi.

Bentuk Informasi: Pengaturan format data (dokumen, audio, video) melalui ms_bentuk_informasi.

4. Manajemen Konten

Berita & Artikel: Kelola konten berita melalui tbl_berita (Judul, deskripsi, gambar, dan status verifikasi).

Profil Lembaga: Pengaturan konten tentang PPID melalui tbl_profil (Visi, misi, tugas, dan fungsi).

Slide Banner: Pengaturan gambar slider depan menggunakan tbl_slide.

Media Sosial: Manajemen link akun sosial media lembaga melalui tbl_sosmed.

SOP & Dokumen IKPHN: Manajemen file Standar Operasional Prosedur melalui sops dan dokumen kinerja melalui ikphns.

5. Master Data Instansi

Data SKPD / OPD: Manajemen daftar Satuan Kerja Perangkat Daerah (SKPD) melalui tbl_skpd (Nama instansi, alamat, email, dan logo).

6. Survei Kepuasan Masyarakat

Kelola Pertanyaan: Pengaturan daftar pertanyaan survei melalui ms_survey dan ms_detail_survey.

Hasil Survei: Laporan jawaban responden yang tersimpan di tbl_survey.

7. Manajemen Pengguna & Keamanan

Daftar Administrator: Kelola akun admin instansi melalui tabel users dan tbl_users.

Role & Permissions: Pengaturan hak akses (Admin Utama, Admin SKPD, Verifikator) melalui roles dan permissions.

8. Sistem & Maintenance

Log Sistem: Pemantauan failed_jobs untuk antrean sistem yang gagal.

Pengaturan API: Manajemen oauth_access_tokens dan oauth_clients jika website terhubung dengan aplikasi mobile atau sistem lain.
