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
                'deskripsi' => '<h2>Tentang PPID Sulawesi Selatan</h2>
<p><strong>Pejabat Pengelola Informasi dan Dokumentasi (PPID)</strong> adalah pejabat yang bertanggung jawab dalam pengumpulan, pendokumentasian, penyimpanan, pemeliharaan, penyediaan, distribusi, dan pelayanan informasi di lingkungan Pemerintah Provinsi Sulawesi Selatan.</p>
<p>PPID Provinsi Sulawesi Selatan dibentuk berdasarkan <strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik dan <strong>Peraturan Gubernur</strong> tentang Pedoman Pengelolaan Informasi dan Dokumentasi.</p>
<p>Era informasi yang berkembang pesat mendorong berbagai elemen masyarakat untuk menuntut hak dasar mereka dalam rangka mewujudkan kehidupan demokratis. Pada masyarakat modern, kebutuhan akan informasi menjadi salah satu kebutuhan penting.</p>

<h2>Tugas dan Fungsi PPID</h2>
<h3>Tugas Utama</h3>
<ul>
<li>Mengelola informasi dan dokumentasi</li>
<li>Menyediakan layanan informasi publik</li>
<li>Mengkoordinasikan PPID Pembantu</li>
<li>Memfasilitasi akses informasi</li>
</ul>

<h3>Fungsi Pendukung</h3>
<ul>
<li>Pengumpulan dan klasifikasi informasi</li>
<li>Penyimpanan dan pemeliharaan data</li>
<li>Distribusi informasi kepada publik</li>
<li>Evaluasi layanan informasi</li>
</ul>

<h2>Prinsip Layanan</h2>
<ul>
<li><strong>Transparansi:</strong> Keterbukaan informasi publik untuk masyarakat</li>
<li><strong>Akuntabilitas:</strong> Pengelolaan informasi yang bertanggung jawab</li>
<li><strong>Profesional:</strong> Layanan prima untuk seluruh masyarakat</li>
</ul>

<h2>Landasan Hukum</h2>
<ul>
<li>UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik</li>
<li>PP No. 61 Tahun 2010 tentang Pelaksanaan UU KIP</li>
<li>Peraturan Komisi Informasi No. 1 Tahun 2010</li>
<li>Peraturan Gubernur Sulawesi Selatan</li>
</ul>'
            ],
            [
                'nm_profil' => 'Sambutan',
                'slug' => 'sambutan',
                'tipe' => 'sambutan',
                'deskripsi' => '<div class="sambutan-content">
<h2>Sambutan Kepala PPID Sulawesi Selatan</h2>
<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p>
<p>Puji syukur kita panjatkan ke hadirat Allah SWT atas limpahan rahmat dan karunia-Nya, sehingga Portal PPID Provinsi Sulawesi Selatan dapat hadir untuk melayani kebutuhan informasi publik.</p>
<p>Portal ini merupakan wujud komitmen Pemerintah Provinsi Sulawesi Selatan dalam menerapkan prinsip transparansi dan akuntabilitas publik sebagaimana diamanatkan dalam Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</p>
<p>Melalui portal ini, masyarakat dapat mengakses berbagai informasi publik yang dikelola oleh Pemerintah Provinsi Sulawesi Selatan dengan mudah, cepat, dan akurat.</p>
<p>Kami berharap kehadiran portal ini dapat meningkatkan partisipasi masyarakat dalam pembangunan daerah dan mewujudkan good governance di Sulawesi Selatan.</p>
<p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>
<p><strong>Kepala PPID Provinsi Sulawesi Selatan</strong></p>
</div>'
            ],
            [
                'nm_profil' => 'Visi Misi',
                'slug' => 'visi-misi',
                'tipe' => 'visi-misi',
                'deskripsi' => '<h2>Visi</h2>
<p>Menjadi Pejabat Pengelola Informasi dan Dokumentasi yang profesional, transparan, dan terpercaya dalam pelayanan informasi publik di Sulawesi Selatan.</p>

<h2>Misi</h2>
<ol>
<li>Menyediakan informasi publik yang akurat, lengkap, dan mudah diakses oleh masyarakat</li>
<li>Meningkatkan kualitas pelayanan informasi publik melalui penerapan teknologi informasi</li>
<li>Membangun sistem pengelolaan informasi dan dokumentasi yang efektif dan efisien</li>
<li>Meningkatkan kapasitas SDM pengelola informasi dan dokumentasi</li>
<li>Memfasilitasi hak masyarakat untuk memperoleh informasi publik sesuai dengan peraturan perundang-undangan</li>
<li>Mengembangkan koordinasi dan sinergi dengan PPID Pembantu di seluruh SKPD</li>
</ol>'
            ],
            [
                'nm_profil' => 'Tupoksi',
                'slug' => 'tupoksi',
                'tipe' => 'tupoksi',
                'deskripsi' => '<h2>Tugas Pokok dan Fungsi PPID Provinsi Sulawesi Selatan</h2>

<h3>Tugas Pokok</h3>
<p>PPID Provinsi Sulawesi Selatan memiliki tugas pokok sebagai berikut:</p>
<ol>
<li>Menyusun dan melaksanakan kebijakan pelayanan informasi publik</li>
<li>Mengkoordinasikan penyimpanan, pendokumentasian, penyediaan, dan pelayanan informasi publik</li>
<li>Mengkoordinasikan dan mengkonsolidasikan pengumpulan bahan informasi dan dokumentasi dari PPID Pembantu</li>
<li>Menguji konsekuensi informasi publik yang dikecualikan</li>
<li>Melakukan koordinasi dengan PPID Pembantu untuk memastikan ketersediaan dan pelayanan informasi</li>
</ol>

<h3>Fungsi</h3>
<p>Dalam melaksanakan tugas pokok tersebut, PPID memiliki fungsi:</p>
<ol>
<li>Penghimpunan informasi publik dari seluruh unit kerja di lingkungan Pemerintah Provinsi Sulawesi Selatan</li>
<li>Pengelolaan informasi dan dokumentasi untuk pelayanan informasi publik</li>
<li>Pelayanan informasi publik sesuai dengan peraturan perundang-undangan</li>
<li>Pengelolaan sistem informasi dan dokumentasi berbasis teknologi informasi</li>
<li>Pemantauan dan evaluasi pelaksanaan pelayanan informasi publik</li>
<li>Pembinaan, supervisi, dan monitoring pelaksanaan tugas PPID Pembantu</li>
<li>Pengkajian dan analisis konsekuensi informasi publik yang dikecualikan</li>
<li>Pelaporan dan pertanggungjawaban pelaksanaan tugas</li>
</ol>

<h3>Kewenangan</h3>
<ol>
<li>Menetapkan standar operasional prosedur pelayanan informasi publik</li>
<li>Memberikan akses informasi publik kepada pemohon informasi</li>
<li>Menolak permohonan informasi publik yang termasuk kategori dikecualikan</li>
<li>Melakukan koordinasi dengan berbagai pihak dalam rangka pelayanan informasi publik</li>
</ol>'
            ],
            [
                'nm_profil' => 'Maklumat Pelayanan',
                'slug' => 'maklumat-pelayanan',
                'tipe' => 'maklumat',
                'deskripsi' => '<h1>MAKLUMAT PELAYANAN</h1>
<h2>PEJABAT PENGELOLA INFORMASI DAN DOKUMENTASI (PPID)<br>PROVINSI SULAWESI SELATAN</h2>

<p>Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan informasi publik sesuai dengan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik dan Peraturan Komisi Informasi dengan standar pelayanan sebagai berikut:</p>

<h3>1. KOMITMEN PELAYANAN</h3>
<ul>
<li>Memberikan pelayanan informasi publik yang cepat, tepat, mudah, dan sederhana</li>
<li>Bersikap ramah, santun, dan profesional dalam memberikan pelayanan</li>
<li>Memberikan informasi yang akurat, benar, dan tidak menyesatkan</li>
<li>Melayani permohonan informasi sesuai dengan ketentuan peraturan perundang-undangan</li>
</ul>

<h3>2. STANDAR PELAYANAN</h3>
<ul>
<li>Permohonan informasi tertulis dijawab paling lambat 10 (sepuluh) hari kerja sejak diterimanya permohonan</li>
<li>Permohonan informasi lisan dijawab pada saat yang bersamaan atau segera pada saat itu juga</li>
<li>Apabila informasi yang dimohon tidak dapat diberikan dalam jangka waktu tersebut, PPID memberikan pemberitahuan tertulis dengan menyebutkan alasan perpanjangan waktu</li>
<li>Biaya perolehan informasi sesuai dengan ketentuan yang berlaku</li>
</ul>

<h3>3. HAK DAN KEWAJIBAN PENGGUNA LAYANAN</h3>
<p><strong>Hak Pengguna Layanan:</strong></p>
<ul>
<li>Mendapatkan informasi publik sesuai dengan peraturan perundang-undangan</li>
<li>Mendapatkan informasi yang benar, jelas, dan tidak menyesatkan</li>
<li>Mendapat pelayanan yang baik dan santun</li>
<li>Menyampaikan pengaduan apabila merasa tidak puas dengan pelayanan</li>
</ul>

<p><strong>Kewajiban Pengguna Layanan:</strong></p>
<ul>
<li>Mengisi formulir permohonan informasi dengan lengkap dan benar</li>
<li>Menyebutkan alasan dan tujuan penggunaan informasi yang dimohon</li>
<li>Menunjukkan identitas diri yang sah</li>
<li>Menggunakan informasi yang diperoleh secara bertanggung jawab</li>
</ul>

<h3>4. SANKSI</h3>
<p>Apabila pelayanan yang diberikan tidak sesuai dengan maklumat ini, kami bersedia menerima sanksi sesuai dengan peraturan perundang-undangan yang berlaku.</p>

<h3>5. PENGADUAN</h3>
<p>Pengaduan, saran, dan masukan dapat disampaikan melalui:</p>
<ul>
<li>Email: ppid@sulsel.go.id</li>
<li>Telepon: (0411) 123456</li>
<li>Langsung ke kantor PPID Provinsi Sulawesi Selatan</li>
<li>Website: ppid.sulsel.go.id</li>
</ul>

<p style="text-align: center; margin-top: 40px;">
<strong>Makassar, 1 Januari 2026</strong><br>
<strong>Kepala PPID Provinsi Sulawesi Selatan</strong>
</p>'
            ],
            [
                'nm_profil' => 'Profil Pemerintah Sulawesi Selatan',
                'slug' => 'profil-pemprov',
                'tipe' => 'pemerintah',
                'deskripsi' => '<h2>Profil Provinsi Sulawesi Selatan</h2>

<h3>Sejarah</h3>
<p>Provinsi Sulawesi Selatan adalah salah satu provinsi di Indonesia yang terletak di bagian selatan Pulau Sulawesi. Provinsi ini memiliki sejarah panjang yang dimulai sejak era kerajaan-kerajaan besar seperti Kerajaan Gowa, Bone, Luwu, dan Wajo yang merupakan kerajaan-kerajaan maritim yang sangat berpengaruh di Nusantara.</p>

<h3>Geografi</h3>
<p><strong>Luas Wilayah:</strong> 45.764,53 km²</p>
<p><strong>Batas Wilayah:</strong></p>
<ul>
<li>Utara: Provinsi Sulawesi Barat dan Sulawesi Tengah</li>
<li>Timur: Teluk Bone dan Provinsi Sulawesi Tenggara</li>
<li>Selatan: Laut Flores</li>
<li>Barat: Selat Makassar</li>
</ul>

<p><strong>Kabupaten/Kota:</strong> Sulawesi Selatan terdiri dari 21 Kabupaten dan 3 Kota:</p>
<ul>
<li>Kota: Makassar (Ibu Kota Provinsi), Palopo, Parepare</li>
<li>Kabupaten: Bantaeng, Barru, Bone, Bulukumba, Enrekang, Gowa, Jeneponto, Kepulauan Selayar, Luwu, Luwu Timur, Luwu Utara, Maros, Pangkajene dan Kepulauan, Pinrang, Sidenreng Rappang, Sinjai, Soppeng, Takalar, Tana Toraja, Toraja Utara, Wajo</li>
</ul>

<h3>Demografi</h3>
<p><strong>Jumlah Penduduk:</strong> Sekitar 9 juta jiwa</p>
<p><strong>Suku Bangsa:</strong></p>
<ul>
<li>Suku Bugis</li>
<li>Suku Makassar</li>
<li>Suku Toraja</li>
<li>Suku Mandar</li>
<li>Dan suku-suku lainnya</li>
</ul>

<h3>Ekonomi</h3>
<p>Sulawesi Selatan memiliki potensi ekonomi yang besar dengan sektor unggulan:</p>
<ul>
<li>Pertanian dan Perkebunan</li>
<li>Perikanan dan Kelautan</li>
<li>Pertambangan</li>
<li>Industri Pengolahan</li>
<li>Pariwisata</li>
<li>Perdagangan dan Jasa</li>
</ul>

<h3>Pemerintahan</h3>
<p><strong>Gubernur:</strong> [Nama Gubernur]</p>
<p><strong>Wakil Gubernur:</strong> [Nama Wakil Gubernur]</p>
<p><strong>Sekretaris Daerah:</strong> [Nama Sekda]</p>

<h3>Visi Pemerintah Provinsi</h3>
<p>Sulawesi Selatan yang Inovatif, Produktif, Kompetitif, Inklusif, dan Berkarakter</p>'
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
