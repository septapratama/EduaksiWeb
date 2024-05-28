<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Artikel;
use Carbon\Carbon;
class ArtikelSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Peran PKK dalam Meningkatkan Kesejahteraan Keluarga di Desa',
                'deskripsi' => 'PKK (Pemberdayaan Kesejahteraan Keluarga) memiliki peran penting dalam meningkatkan kualitas hidup keluarga di desa. Program-program yang dijalankan oleh PKK mencakup pelatihan keterampilan, kesehatan ibu dan anak, serta pengelolaan keuangan rumah tangga. Melalui kegiatan-kegiatan ini, PKK membantu memberdayakan perempuan dan memperkuat ekonomi keluarga di desa.

                Selain itu, PKK juga aktif dalam mengadakan kegiatan sosial dan kemasyarakatan seperti posyandu, penyuluhan gizi, dan kampanye kebersihan lingkungan. Partisipasi aktif para perempuan dalam kegiatan PKK menciptakan komunitas yang lebih sehat dan berdaya. Kegiatan-kegiatan ini tidak hanya meningkatkan kesejahteraan keluarga tetapi juga mempererat hubungan sosial antarwarga.
                
                PKK memainkan peran vital dalam meningkatkan kesejahteraan keluarga di desa melalui berbagai program yang memberdayakan perempuan dan mendukung kesehatan serta ekonomi keluarga. Kegiatan-kegiatan PKK juga memperkuat ikatan sosial dan komunitas di desa.
                ',
                'kategori'=> 'disi',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Festival Desa: Meningkatkan Solidaritas dan Kebersamaan Warga',
                'deskripsi' => 'Festival desa adalah acara tahunan yang sangat dinantikan oleh seluruh warga. Acara ini diisi dengan berbagai kegiatan seperti pameran produk lokal, lomba masak, dan pertunjukan seni tradisional. Festival ini menjadi ajang bagi warga untuk berkumpul, merayakan kebudayaan, dan mempererat hubungan sosial.

                Selain itu, festival desa juga menjadi sarana untuk mempromosikan produk-produk lokal kepada pengunjung dari luar desa. Pengunjung dapat menikmati aneka kuliner khas desa dan membeli kerajinan tangan buatan warga. Festival ini tidak hanya meningkatkan rasa kebersamaan tetapi juga memberikan peluang ekonomi bagi masyarakat desa.
                
                Festival desa adalah momen penting yang mempererat solidaritas antarwarga dan mempromosikan kekayaan budaya serta produk lokal. Acara ini memberikan manfaat sosial dan ekonomi yang signifikan bagi masyarakat desa.
                ',
                'kategori'=> 'disi',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Gotong Royong: Tradisi yang Menyatukan Warga Desa',
                'deskripsi' => 'Gotong royong adalah tradisi yang masih kuat dijalankan di desa-desa. Setiap bulan, warga desa berkumpul untuk melakukan berbagai kegiatan seperti membersihkan lingkungan, memperbaiki fasilitas umum, dan membangun infrastruktur desa. Tradisi ini mencerminkan nilai kebersamaan dan solidaritas yang tinggi di antara warga desa.

                Kegiatan gotong royong ini juga menjadi sarana untuk mempererat hubungan antarwarga dan menciptakan rasa saling memiliki. Dengan bekerja bersama-sama, warga dapat menyelesaikan berbagai pekerjaan lebih cepat dan efisien. Tradisi ini biasanya diakhiri dengan makan bersama sebagai simbol kebersamaan dan kerukunan.
                
                Gotong royong adalah tradisi yang penting dalam menjaga kebersihan dan kenyamanan desa, serta memperkuat ikatan sosial antarwarga. Melalui kegiatan gotong royong, warga dapat bekerja sama dan membangun lingkungan yang lebih baik.
                ',
                'kategori'=> 'disi',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Pendidikan di Desa: Membangun Generasi Masa Depan',
                'deskripsi' => 'Pendidikan di desa memegang peranan penting dalam membentuk masa depan generasi muda. Sekolah-sekolah di desa menyediakan pendidikan dasar dan menengah yang berkualitas, dengan guru-guru yang berdedikasi. Selain itu, ada berbagai kegiatan ekstrakurikuler yang membantu mengembangkan bakat dan minat siswa, mulai dari seni hingga olahraga.

                Pemerintah desa juga menyediakan beasiswa bagi siswa berprestasi yang berasal dari keluarga kurang mampu, serta mengadakan pelatihan dan workshop untuk meningkatkan kualitas pendidikan. Upaya ini bertujuan untuk memastikan bahwa anak-anak di desa mendapatkan pendidikan yang layak dan dapat bersaing di tingkat yang lebih tinggi.
                
                Pendidikan di desa adalah kunci untuk membangun generasi yang cerdas dan kompetitif. Dengan berbagai program dan fasilitas yang ada, desa berusaha memberikan pendidikan yang terbaik bagi anak-anaknya, sehingga mereka siap menghadapi tantangan masa depan.
                ',
                'kategori'=> 'disi',
                'foto' => '4.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Acara Mingguan di Desa: Menjalin Kebersamaan dan Kesehatan',
                'deskripsi' => 'Acara mingguan seperti senam pagi dan arisan menjadi bagian rutin dari kehidupan di desa. Setiap minggu, warga desa berkumpul untuk berpartisipasi dalam senam pagi yang dipandu oleh instruktur lokal. Kegiatan ini tidak hanya menjaga kesehatan tetapi juga menjadi ajang silaturahmi antarwarga.

                Selain senam pagi, arisan juga menjadi acara mingguan yang populer di desa. Setiap keluarga bergiliran menjadi tuan rumah arisan, yang biasanya diikuti dengan makan bersama dan diskusi ringan. Kegiatan ini memperkuat hubungan sosial dan membantu warga saling mendukung secara ekonomi.
                
                Acara mingguan di desa seperti senam pagi dan arisan memainkan peran penting dalam menjalin kebersamaan dan menjaga kesehatan warga. Kegiatan-kegiatan ini memperkuat ikatan sosial dan menciptakan komunitas yang lebih solid dan sehat.
                ',
                'kategori'=> 'disi',
                'foto' => '5.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pertanian Berkelanjutan: Menuju Ketahanan Pangan di Desa',
                'deskripsi' => 'Pertanian berkelanjutan menjadi fokus utama bagi banyak desa dalam upaya mencapai ketahanan pangan. Petani di desa-desa menerapkan teknik-teknik pertanian organik yang ramah lingkungan, seperti penggunaan pupuk kompos dan pengendalian hama terpadu. Praktik ini tidak hanya menghasilkan produk yang sehat tetapi juga menjaga kelestarian lingkungan.

                Pemerintah desa dan berbagai organisasi non-pemerintah sering mengadakan pelatihan untuk meningkatkan pengetahuan petani tentang teknik pertanian modern yang berkelanjutan. Hasil pertanian yang berkualitas juga dipromosikan melalui pasar-pasar lokal dan festival desa, meningkatkan pendapatan petani dan kesejahteraan masyarakat.
                
                Pertanian berkelanjutan adalah kunci untuk mencapai ketahanan pangan di desa. Dengan menerapkan praktik-praktik yang ramah lingkungan, desa dapat menghasilkan produk yang sehat dan berkualitas, serta menjaga keseimbangan ekosistem.
                ',
                'kategori'=> 'disi',
                'foto' => '6.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Kesenian Tradisional: Melestarikan Warisan Budaya di Desa',
                'deskripsi' => 'Kesenian tradisional menjadi bagian tak terpisahkan dari kehidupan masyarakat desa. Tari-tarian, musik, dan kerajinan tangan sering dipentaskan dan dipamerkan dalam berbagai acara desa. Seni tradisional ini tidak hanya menjadi hiburan tetapi juga merupakan warisan budaya yang perlu dilestarikan.

                Desa sering mengadakan pelatihan dan workshop untuk generasi muda agar mereka dapat belajar dan mengapresiasi seni tradisional. Sekolah-sekolah juga memasukkan kesenian tradisional dalam kurikulum mereka. Upaya ini bertujuan untuk memastikan bahwa warisan budaya desa tetap hidup dan berkembang di masa depan.
                
                Kesenian tradisional adalah aset budaya yang berharga bagi desa. Melalui berbagai upaya pelestarian, desa dapat menjaga dan mengembangkan seni tradisional, sehingga warisan budaya ini dapat dinikmati oleh generasi mendatang.
                ',
                'kategori'=> 'disi',
                'foto' => '7.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Acara Musiman di Desa: Merayakan Tradisi dan Kebersamaan',
                'deskripsi' => 'Acara musiman seperti festival panen dan sedekah bumi menjadi bagian penting dari kehidupan sosial di desa. Setiap tahun, warga desa berkumpul untuk merayakan hasil panen dengan doa bersama, pementasan seni, dan makan bersama. Acara ini menjadi ungkapan syukur dan mempererat hubungan antarwarga.

                Selain itu, desa juga mengadakan lomba layang-layang saat musim angin, yang menjadi hiburan dan daya tarik bagi wisatawan. Setiap keluarga berpartisipasi dengan membuat dan menerbangkan layang-layang terbaik mereka. Acara ini menciptakan kebersamaan dan menjadi kesempatan untuk melestarikan tradisi.
                
                Acara musiman di desa adalah momen penting yang merayakan tradisi dan mempererat kebersamaan antarwarga. Kegiatan-kegiatan ini memperkaya kehidupan sosial dan budaya di desa, serta menarik minat wisatawan.
                ',
                'kategori'=> 'disi',
                'foto' => '8.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pengelolaan Sampah: Menuju Desa yang Bersih dan Sehat',
                'deskripsi' => 'Pengelolaan sampah menjadi fokus utama dalam menjaga kebersihan dan kesehatan di desa. Program pemilahan sampah di tingkat rumah tangga telah diterapkan, dengan sampah organik diolah menjadi kompos dan sampah anorganik dikumpulkan untuk didaur ulang. Inisiatif ini membantu mengurangi jumlah sampah yang dibuang ke lingkungan.

                Kampanye sadar lingkungan dan edukasi tentang pentingnya pengelolaan sampah juga rutin diadakan. Tempat sampah disediakan di berbagai titik strategis untuk memudahkan warga dalam membuang sampah. Upaya ini menciptakan lingkungan yang lebih bersih dan sehat, serta meningkatkan kesadaran warga tentang pentingnya menjaga kebersihan.
                
                Pengelolaan sampah yang efektif di desa adalah langkah penting menuju lingkungan yang bersih dan sehat. Dengan dukungan warga dan program edukasi yang baik, desa dapat mengurangi dampak negatif sampah dan menciptakan lingkungan yang nyaman untuk ditinggali.
                ',
                'kategori'=> 'disi',
                'foto' => '9.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Kerjasama Antarwarga dalam Membangun Desa',
                'deskripsi' => 'Kerjasama antarwarga adalah fondasi penting dalam membangun desa yang maju dan sejahtera. Setiap proyek pembangunan, baik itu infrastruktur maupun program sosial, melibatkan partisipasi aktif dari seluruh warga. Melalui musyawarah dan gotong royong, desa dapat mengidentifikasi kebutuhan dan merencanakan langkah-langkah untuk memenuhinya.

                Kerjasama ini juga terlihat dalam kegiatan-kegiatan sosial seperti arisan, posyandu, dan kegiatan keagamaan. Setiap warga memiliki peran dalam menjaga dan mengembangkan desa mereka, menciptakan rasa kebersamaan dan tanggung jawab bersama. Dengan bekerja sama, desa dapat mencapai berbagai tujuan pembangunan dengan lebih efektif.
                
                Kerjasama antarwarga adalah kunci dalam membangun desa yang maju dan sejahtera. Partisipasi aktif dan rasa tanggung jawab bersama menciptakan lingkungan yang harmonis dan mendukung pencapaian tujuan pembangunan desa.
                ',
                'kategori'=> 'disi',
                'foto' => '10.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $artikel) {
            Artikel::insert($artikel);
            $destinationPath = public_path('img/artikel/' . $artikel['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Artikel/' . $artikel['foto']), $destinationPath);
        }
    }
}