<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profil;

class ProfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profiles = [
            [
                'nm_profil' => 'Profil PPID',
                'slug' => 'profil-ppid',
                'tipe' => 'profil-ppid',
                'deskripsi' => '<h3>Tentang PPID Sulawesi Selatan</h3>
<p><strong>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</strong> adalah pejabat yang bertanggung jawab dalam pengumpulan, pendokumentasian, penyimpanan, pemeliharaan, penyediaan, distribusi, dan pelayanan informasi di lingkungan Pemerintah Provinsi Sulawesi Selatan.</p>
<p>PPID Provinsi Sulawesi Selatan dibentuk berdasarkan <strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik dan <strong>Peraturan Gubernur</strong> tentang Pedoman Pengelolaan Informasi dan Dokumentasi.</p>
<p>Era informasi yang berkembang pesat mendorong berbagai elemen masyarakat untuk menuntut hak dasar mereka dalam rangka mewujudkan kehidupan demokratis. Pada masyarakat modern, kebutuhan akan informasi menjadi salah satu penting.</p>

<h3>Tugas dan Fungsi PPID</h3>
<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
    <div>
        <h4>Tugas Utama</h4>
        <ul>
            <li>Mengelola informasi dan dokumentasi</li>
            <li>Menyediakan layanan informasi publik</li>
            <li>Mengkoordinasikan PPID Pembantu</li>
            <li>Memfasilitasi akses informasi</li>
        </ul>
    </div>
    <div>
        <h4>Fungsi Pendukung</h4>
        <ul>
            <li>Pengumpulan dan klasifikasi informasi</li>
            <li>Penyimpanan dan pemeliharaan data</li>
            <li>Distribusi informasi kepada publik</li>
            <li>Evaluasi layanan informasi</li>
        </ul>
    </div>
</div>'
            ],
            [
                'nm_profil' => 'Sambutan Kepala PPID',
                'slug' => 'sambutan',
                'tipe' => 'sambutan',
                'deskripsi' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,<br>Salam Sejahtera untuk kita semua,</p>
<p>Era informasi yang telah digunakan bersamaan yang lalu (1998), dan mendorong berbagai elemen masyarakat untuk menuntut hak dasar mereka dalam rangka mewujudkan kehidupan demokratis. Pada masyarakat modern, kebutuhan akan informasi menjadi salah satu penting. Penyeberasan informasi mendorong kebebasan akan informasi semenjak mereka tidaklah sejalan dengan kondisi dan konstitusi yang ada.</p>
<p>Lahirnya Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik (UU KIP) memberikan mandat kepada pelaksanaan pemerintahan yang transparan dan akuntabel untuk memenuhi hak setiap orang dalam memperoleh informasi sesuai dengan ketentuan peraturan perundang-undangan yang berlaku.</p>
<p>Dalam rangka mendukung proses penyajian dan pelayanan informasi untuk publik, maka Pejabat Pengelola Informasi dan Dokumentasi (PPID) merupakan pihak yang ditunjuk langsung sesuai dengan kemampuan khusus dan kapasitas dalam memberikan berbagai informasi yang dibutuhkan oleh masyarakat.</p>
<p>Semoga dengan adanya Portal PPID ini, masyarakat dapat dengan mudah mengakses berbagai informasi yang diperlukan dan turut serta dalam pengawasan penyelenggaraan pemerintahan. Kritik dan saran yang membangun sangat kami harapkan demi peningkatan kualitas layanan kami.</p>
<p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>'
            ],
            [
                'nm_profil' => 'Visi Misi',
                'slug' => 'visi-misi',
                'tipe' => 'visi-misi',
                'deskripsi' => '<h3>Visi PPID Sulawesi Selatan</h3>
<blockquote>"Terwujudnya pelayanan informasi yang transparan dan akuntabel untuk memenuhi hak setiap orang informasi dengan keterbukaan peraturan perundang-undangan yang berlaku"</blockquote>

<h3>Misi PPID Sulawesi Selatan</h3>
<p>Untuk mewujudkan visi tersebut, PPID Sulawesi Selatan memiliki 3 misi utama:</p>
<ol>
    <li><strong>Meningkatkan Pengelolaan Informasi</strong> - Mengelola pengumpulan dan penyebarluasan informasi yang berkualitas dan profesional</li>
    <li><strong>Meningkatkan Kompetensi SDM</strong> - Meningkatkan kompetensi sumber daya manusia dalam bidang Pelayanan Informasi</li>
    <li><strong>Forum Koordinasi PPID</strong> - Membentukan Forum Koordinasi PPID tingkat Pemprov Sulsel yang solid</li>
</ol>'
            ],
            [
                'nm_profil' => 'Tugas dan Fungsi (Tupoksi)',
                'slug' => 'tupoksi',
                'tipe' => 'tupoksi',
                'deskripsi' => '<h3>Tugas dan Tanggung Jawab PPID</h3>
<p>PPID memiliki tugas dan tanggung jawab dalam pengumpulan, pendokumentasian, penyediaan, dan pelayanan Informasi Publik, melakukan verifikasi dokumen Informasi Publik.</p>

<h3>Tugas PPID Utama</h3>
<p>Pejabat Pengelola Informasi dan Dokumentasi (PPID) memiliki tugas dan tanggung jawab dalam melakukan verifikasi bahan Informasi Publik, dan penyediaan Informasi Publik yang akurat, benar dan tidak menyesatkan:</p>
<ol>
    <li>Melakukan pengumpulan, pendokumentasian, penyediaan, dan pelayanan Informasi Publik</li>
    <li>Melakukan verifikasi dokumen Informasi Publik</li>
    <li>Menguji konsekuensi Informasi Publik yang dibuka terhadap rahasia negara</li>
    <li>Melakukan pengklasifikasian Informasi Publik and/atau pengubahannya</li>
    <li>Menetapkan Informasi Publik yang mudah diakses oleh publik</li>
    <li>Menyediakan Informasi Publik yang wajib diakses oleh publik</li>
    <li>Menyediakan Informasi Publik dan Daftar Informasi Publik yang Dikecualikan</li>
    <li>Melakukan pembaruan, pengelolaan dan pengamanan informasi</li>
    <li>Menyediakan sarana dan prasarana layanan informasi publik</li>
    <li>Menyiapkan kebijakan teknis informasi publik yang dilakukan oleh PPID Pelaksana</li>
</ol>

<h3>Tugas PPID Pelaksana</h3>
<p>PPID Pelaksana bertanggung jawab membantu PPID dalam menyimpan, mengklasifikasi, dan menyebarkan dokumen Informasi publik:</p>
<ol>
    <li>Menyediakan, memberikan dan menerbitkan Informasi Publik yang berada di bawah kewenangannya</li>
    <li>Membantu PPID dalam menyimpan, mengklasifikasi, dan menyebarkan dokumen Informasi publik</li>
    <li>Memberikan pelayanan permohonan Informasi Publik yang langsung diambil, surat, fax, e-mail, dengan website PPID</li>
    <li>Membuat laporan layanan Informasi publik secara berkala</li>
    <li>Membuat, memelihara, dan/atau memutakhirkan daftar Informasi Publik yang berada dibawah penguasaannya secara berkala, dan melakukan uji keterbukaan terhadap pelayanan informasi publik</li>
</ol>'
            ],
            [
                'nm_profil' => 'Maklumat Pelayanan',
                'slug' => 'maklumat',
                'tipe' => 'maklumat',
                'deskripsi' => '<h3>Komitmen PPID</h3>
<p>Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan informasi publik dengan sebaik-baiknya sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</p>
<p><em>"Apabila pelayanan kami tidak sesuai dengan standar yang telah ditetapkan, kami siap menerima sanksi sesuai dengan peraturan perundang-undangan yang berlaku."</em></p>

<h3>Standar Pelayanan</h3>
<ul>
    <li>Memberikan layanan informasi yang cepat, mudah, dan sederhana</li>
    <li>Menyediakan informasi yang akurat, benar, dan tidak menyesatkan</li>
    <li>Melayani permohonan informasi sesuai waktu yang ditentukan</li>
    <li>Memberikan alasan tertulis jika permohonan ditolak</li>
</ul>'
            ],
            [
                'nm_profil' => 'Profil Pemerintah Provinsi',
                'slug' => 'pemerintah',
                'tipe' => 'pemerintah',
                'deskripsi' => '<h3>Profil Provinsi</h3>
<p><strong>Sulawesi Selatan</strong> merupakan salah satu provinsi di Indonesia yang terletak di bagian selatan Pulau Sulawesi. Sulawesi Selatan berbatasan dengan Provinsi Sulawesi Barat di sebelah utara, Teluk Bone dan Sulawesi Tenggara di timur, Selat Makassar di barat, dan Laut Flores di selatan.</p>
<p>Sulawesi Selatan memiliki luas wilayah 46.717,48 km² dengan jumlah penduduk sekitar 9,07 juta jiwa. Wilayah ini terbagi menjadi 21 kabupaten dan 3 kota dengan Makassar sebagai ibu kota provinsi.</p>
<p>Provinsi ini terkenal dengan kekayaan budayanya yang beragam, terutama budaya Bugis, Makassar, dan Toraja. Sulawesi Selatan juga memiliki potensi ekonomi yang besar terutama dalam bidang pertanian, perikanan, perdagangan, dan pariwisata.</p>'
            ],
        ];

        foreach ($profiles as $profile) {
            Profil::updateOrCreate(
                ['tipe' => $profile['tipe']],
                $profile
            );
        }
    }
}
