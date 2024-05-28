<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Emotal;
use Carbon\Carbon;
class EmotalSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'KENALI PERKEMBANGAN EMOSI ANAK USIA DINI',
                'deskripsi' => 'Kemampuan emosional menitikberatkan pada kondisi anak untuk dapat mengenali, mengekspresikan dan mengelola rentang emosi. Anak yang mampu mengelola perasaan nantinya akan mampu mengembangkan citra diri yang positif dan jadi pribadi yang percaya diri. Sejak bayi, seseorang bisa mengenali emosi seperti bahagia, sedih, takut, dan marah.
                Lalu saat menjadi anak-anak, emosi ini pun berkembang menjadi rasa malu, terkejut, bersalah, bangga dan empati. Seiring dengan pengalamannya, emosi ini juga akan berkembang dan tiap anak berbeda pula cara penanganannya.
                Inilah pentingnya peran orang tua untuk mengarahkan perkembangan emosi anak. Sebagai orang tua, Ibu bisa melakukan beberapa hal untuk membangun kecerdasan emosional anak sejak dini.
                1.	Mengenali Emosi Anak
                Orang tua adalah sosok yang paling berpengaruh dalam membantu anak mengenalkan berbagai macam emosi yang dirasakan anak. Ibu bisa membantu anak untuk mengidentifikasi emosinya sendiri seperti senang, marah, sedih, kecewa, dan lainnya.
                
                Ibu bisa menjelaskan apa dan bagaimana setiap emosi itu dan dampaknya bagi orang lain. Misalnya jika anak marah, apa dampaknya bagi orang di sekitarnya. Mengenalkan emosi ini bisa dengan tulisan dan gambar yang bisa dipahami oleh nalar anak usia dini. Usahakan untuk tetap berpikir positif untuk setiap emosi yang dirasakan anak seperti marah atau sedih untuk mengajarkan setiap emosi adalah baik untuk diterima.
                2.	Mengenalkan Emosi Orang Tua
                Setelah anak memahami emosi yang dirasakannya, lalu kembangkan informasi tentang emosi yang dirasakan orang tua. Ceritakan hal yang membuat orang tuanya senang atau sedih untuk melatih kecerdasan emosional dan empati terhadap orang lain. Untuk emosi negatif seperti marah, sedih, kecewa, Ibu bisa mengajarkan juga cara mengendalikan emosi tersebut dan bagaimana harus bersikap di depan orang.
                3.	Kenali Kaitan Suasana dan Perasaan
                Perkembangan emosi sangat erat kaitannya dengan suasana yang ada di sekitarnya. Anak bisa bosan berada di rumah seharian sehingga membuatnya gelisah atau marah. Bisa jadi anak sangat senang dengan mainan baru atau suasana rumah yang berbeda dari biasanya seperti kedatangan anggota keluarga dari luar. Dengan mengenali kaitan antara perasaan dan suasana, Ibu bisa mengajarkan pada anak tentang emosi yang muncul karena faktor di luar dirinya sendiri.
                4.	Kenali Emosi Anak dengan Suasana Berbeda di Berbagai Tempat
                Jika anak sudah memahami tentang perubahan suasana di dalam rumah, tentunya akan sangat berbeda jika anak berada di luar rumah dan tempat yang berbeda-beda. Suasana yang cepat berubah dan berhubungan dengan orang yang berbeda-beda pula akan merangsang kepekaan emosinya.
                
                Perhatikan emosi anak ketika berada di keramaian, di tempat sepi, bertemu dengan orang tak dikenal, atau tempat yang membuatnya nyaman dan bahagia. Dengan mengenali berbagai kondisi ini, anak akan belajar mengelola emosi secara cepat.
                Jika perkembangan emosi anak usia dini mendapatkan perhatian penuh, maka akan muncul dampak positif pada anak, yaitu pengarahan pengelolaan emosi yang baik akan membuat anak tersebut berkembang dengan kontrol emosi yang baik dan merangsang kemampuan intelektual anak, memiliki kemampuan berimajinasi, dan mencintai dirinya sendiri.
                Sebaliknya, jika anak tidak mampu mengontrol emosi dan perkembangan emosi yang buruk, maka anak bisa mendapatkan pengalaman emosi yang tidak menyenangkan dan mempengaruhi kemampuan berbicara dan terhambatnya perkembangan intelektualnya
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'TAHAPAN PERKEMBANGAN EMOSI',
                'deskripsi' => 'Pada dasarnya perkembangan emosi anak usia dini akan berkembang dengan sendirinya. Namun tetap butuh dukungan penuh dari lingkungan sekitarnya terutama orang tua untuk bisa mengembangkan kecerdasan emosional ini dengan baik. Jika kecerdasan emosional ini berkembang secara positif, maka kecerdasan intelektualnya juga akan berkembang dengan optimal seperti kemampuan untuk memahami sebuah peristiwa, dan mengelola emosi sesuai dengan keadaannya.
                Perkembangan emosi anak usia dini biasanya ditunjukkan pada reaksi fisik yang kemudian berkembang dalam mengenali berbagai jenis emosi sesuai dengan umurnya. Ada banyak faktor yang mempengaruhi anak dalam mengenali dan mengekspresikan emosinya, seperti faktor kematangan yang dipengaruhi oleh kelenjar endokrin. Kurangnya produksi kelenjar endokrin akan berpengaruh pada reaksi fisiologis anak terhadap penanganan stress. Namun tentu saja faktor pembelajaran secara alami juga berpengaruh besar dalam menunjang perkembangan emosi anak usia dini. Berikut ini beberapa metode belajar anak dalam menentukan perkembangan emosi anak usia dini.
                1.	Mencoba
                Cara belajar anak yang pertama adalah mempelajari dan mencoba-coba. Setiap anak akan mencoba berbagai macam perilaku yang dia tahu dan memlih mana yang memberikan kepuasan terbesar pada dirinya lalu mengeliminasi perilaku yang memberikan sedikit kepuasan.
                2.	Meniru
                Cara belajar meniru akan melibatkan orang-orang yang ada di sekitarnya. Emosi mana saja yang mempengaruhi rangsangannya dalam kondisi tertentu. Anak akan mengamati hal apa saja yang bisa membangkitkan emosi orang lain dan menirunya seperti apa yang terjadi pada orang tersebut. Misalnya jika melihat orang marah lalu melempar barang, maka dia akan meniru hal tersebut.
                3.	Mengidentifikasi
                Hampir sama dengan meniru, naun mengidentifikasi ini akan berfokus pada orang yang dikagumi dan memiliki ikatan kuat dengan anak, misalnya orang tua. Hal ini akan membuat keinginan untuk meniru emosi orang tersebut lebih kuat dibandingkan meniru sembarangan orang yang dilihatnya.
                4.	Mengkondisikan
                Anak akan mengasosiasikan objek dan situasi yang awalnya gagal memancing reaksi emosionalnya. Cara belajar ini sangat umum terjadi pada anak usia dini karena kurangnya pengalaman dan tidak menyadari bahwa apa yang dilakukan tidak rasional.
                5.	Melatih
                Perkembangan emosi anak yang baik dengan bimbingan orang dewasa dengan cara mengajarkan bagaimana bereaksi terhadap emosi tertentu. Anak akan melatih diri untuk memberikan reaksi pada rangsangan menyenangkan, dan mengendalikan emosi pada rangsangan yang tidak menyenangkan.
                Pada akhirnya, perkembangan emosi anak usia dini akan berjalan secara alami. Tapi, tentunya Ibu juga ingin ikut berperan dalam mengelola dan mengembangkan emosi anak menjadi lebih baik dengan cara positif sehingga nantinya anak memiliki kecerdasan emosional yang mampu mendukung karakter anak menjadi sosok yang percaya diri dan bercitra positif.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'BAGAIMANAKAH PERAN FUNGSI KELUARGA PADA MASALAH MENTAL EMOSIONAL ANAK',
                'deskripsi' => 'Keluarga merupakan lingkungan utama bagi individu sejak lahir. Anak tumbuh dan berkembang dalam lingkungan keluarga sejak lahir. Hal ini menyebabkan keluarga menjadi peran utama dalam proses tumbuh kembang anak, baik secara langsung maupun tidak langsung. Seorang anak yang tumbuh dan berkembang dengan baik diharapkan menjadi orang dewasa yang sehat secara mental, sosial, dan biologis. Anak-anak, seiring waktu, akan memiliki kemampuan untuk beradaptasi dengan orang lain di sekitarnya. Kesehatan mental dan psikososial pada anak memerlukan perhatian dan intervensi dari berbagai pihak, baik keluarga, pendidikan maupun masyarakat. Berdasarkan laporan WHO, diperkirakan 10-20% populasi anak dan remaja akan mengalami gangguan masalah emosional dan mental. Anak yang memiliki mental well-being yang baik diharapkan mampu menghadapi berbagai persoalan hidup.
                Keluarga merupakan kunci utama dalam tahap perkembangan emosi dan mental anak. Anak yang berada dalam lingkungan keluarga yang positif dapat meningkatkan kemampuan anak dalam mengendalikan masalah emosi. Keluarga memainkan peran besar dalam kesehatan fisik dan mental seorang anak. Keluarga berperan dalam pencegahan dan memiliki fungsi memberikan kenyamanan emosional, mendidik, membantu dalam memecahkan masalah, memenuhi kebutuhan keuangan dan menjaga kesehatan anggota keluarganya.
                Masalah emosional dan mental pada anak dan remaja telah menjadi fokus utama masalah kesehatan dunia karena berkaitan dengan penderitaan, masalah fungsional, paparan stigma, dan diskriminasi serta berpotensi menyebabkan kematian. Menurut laporan Riskesdas Indonesia tahun 2018, angka gangguan emosi dan mental di Indonesia sebesar 9,6%. Angka ini meningkat dibandingkan hasil tahun 2013 yang sebesar 6,0%. Masalah emosi dan perilaku yang terjadi pada anak dan remaja cukup serius dan tidak bisa dianggap remeh karena dapat berdampak pada tumbuh kembang. National Institute of Mental Health (NIMH) juga menyatakan prevalensi gangguan emosi dan mental pada anak usia prasekolah sekitar 10-15% di dunia. Deteksi dini sangat penting dilakukan sebelum anak memasuki masa sekolah. Deteksi dini bermanfaat sebagai upaya pencegahan masalah emosional dan mental anak. Sampai saat ini, hanya ada sedikit penelitian tentang gangguan kejiwaan pada anak di negara berkembang.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => '8 CARA SEDERHANA MENJAGA KESEHATAN MENTAL ANAK',
                'deskripsi' => '1.	Memberikan dukungan emosional
                Cobalah untuk merasakan emosi anak, dengarkan baik-baik dan tunjukkan bahwa kamu peduli dengan perasaan dan pikiran mereka. Dukungan emosional yang konsisten dapat membantu anak mengatasi stres dan meningkatkan rasa percaya diri mereka.
                2.	Membangun ikatan yang sehat
                Ikatan yang kuat dengan orang tua dan keluarga dapat memberikan perlindungan dan dukungan kuat yang anak butuhkan. Luangkan waktu untuk anak, ikut serta dalam aktivitas yang mereka sukai, dan tunjukkan bahwa kamu mendukung dan mencintai mereka.
                3.	Mendorong komunikasi terbuka
                Penting untuk mendorong anak-anak untuk jujur tentang perasaan dan pikiran mereka. Ciptakan lingkungan yang aman dan terbuka di mana anak dapat merasa nyaman dan membicarakan perasaan mereka. Dengarkan baik-baik tanpa menghakimi dan tawarkan dukungan dan pengertian. 
                4.	Jaga kesehatan mental anak dengan membantu mengelola stress
                Ajari anak teknik-teknik pengelolaan stres yang sederhana, seperti pernapasan dalam, berolahraga, atau bermain di luar ruangan. Manajemen stres yang efektif membantu anak menjaga keseimbangan emosional mereka.
                5.	Membantu anak mengembangkan minat dan bakat
                Membantu anak menemukan minat dan bakatnya dapat berdampak positif. Biarkan anak mencoba berbagai aktivitas seperti seni, olahraga, atau musik dan beri penghargaan atas usahanya. Mengembangkan minat dan keterampilan membuat anak merasa energik, memiliki tujuan, dan sukses, yang mendorong secara positif.
                6.	Mengatur rutinitas yang sehat
                Menciptakan rutinitas yang sehat membuat anak merasa aman dan teratur. Pastikan anak memiliki waktu istirahat yang cukup, tidur yang cukup, makan makanan bergizi dan menjaga keseimbangan antara aktivitas fisik dan mental. Rutinitas harian yang teratur dan seimbang dapat membantu menjaga kestabilan emosi anak.
                7.	Mengawasi paparan media
                Mengontrol dan memantau paparan anak terhadap media penting untuk dilakukan. Bicaralah dengan anak tentang media yang mereka konsumsi dan ajari mereka apa yang sehat dan tidak sehat di media sosial, game online, ataupun acara TV.
                8.	Mendukung keterampilan social
                Ajari anak untuk mempunyai rasa empati, kerja sama, toleransi, dan komunikasi yang efektif. Dorong mereka untuk berpartisipasi dalam kegiatan sosial seperti bermain dengan teman sebaya, bergabung dengan kelompok, atau menjadi sukarelawan.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '4.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => '3 Tahap Perkembangan Emosi Anak Usia Dini',
                'deskripsi' => '1)	Bayi Baru Lahir - Usia 1 Tahun: Tahap Mengenali Emosi
                Pada tahap ini, Si Kecil mulai mengenal dunia di sekitarnya. Mereka belajar membedakan antara hal-hal yang menyenangkan dan yang tidak. Misalnya, mereka merasa senang saat dipeluk dan tidak nyaman dengan popok yang penuh atau basah. Cara Si Kecil menangis dan bergumam adalah bentuk komunikasi awal mereka. Untuk membantu Si Kecil di tahap ini, Bunda dapat menciptakan lingkungan yang aman dan konsisten. Lingkungan yang stabil dan penuh kasih ini memungkinkan Si Kecil merasa percaya diri untuk menjelajah dan mengekspresikan diri. Cara lain untuk mendukung tahap ini adalah dengan membiarkan Si Kecil menenangkan diri dengan cara mereka sendiri, seperti mengisap jempol. Ini adalah bagian penting dari pengaturan emosi. Selain itu, sangat membantu jika Bunda menunjukkan emosi secara terbuka. Anak-anak cenderung meniru perilaku orang tua mereka. Ketika Bunda menunjukkan cara mengelola emosi, Si Kecil juga akan belajar dari contoh tersebut.
                2)	Usia 2-3 Tahun: Tahap Mengekspresikan Emosi
                Di usia 2 hingga 3 tahun, Si Kecil mulai mengekspresikan emosi dengan berbagai cara. Mereka mungkin menggambar untuk mengekspresikan perasaan atau mengalami tantrum saat frustasi. Ini adalah tahap penting di mana Si Kecil belajar tentang ekspresi emosi. Bunda, saat Si Kecil mengalami tantrum, penting untuk tetap tenang. Bantu mereka mengarahkan emosi mereka dengan cara yang penuh empati dan kejelasan. 
                Ajari Si Kecil untuk menggunakan kata-kata dalam mengungkapkan perasaan mereka, seperti mengatakan "Aku marah karena ..." Ini akan membantu mereka memahami dan mengelola emosi mereka daripada hanya meluapkannya. Berikan pujian atas kemajuan Si Kecil dalam mengekspresikan diri. Misalnya, jika mereka berhasil mengungkapkan perasaan mereka dengan kata-kata, tunjukkan apresiasi Bunda. Ini akan membangun kepercayaan diri mereka dan mendorong perkembangan emosional mereka lebih lanjut.
                3)	Tahap 3-5 Tahun: Tahap Mengendalikan Emosi
                Pada usia 3 hingga 5 tahun, Si Kecil memasuki lingkungan baru di jenjang pendidikan prasekolah. Mereka akan mengembangkan keterampilan untuk mengelola emosi secara mandiri. Ini adalah tahap penting di mana Si Kecil belajar menghadapi tantangan dan mengelola emosi dalam konteks sosial. Bunda dapat mengajarkan strategi seperti mencari tempat tenang, bernapas dalam-dalam, atau mewarnai buku untuk membantu Si Kecil mengatasi emosi mereka. Cobalah praktikkan strategi ini bersama Si Kecil. Menjadi contoh yang baik dalam menghadapi emosi akan sangat membantu mereka.
                Penting juga untuk memiliki ekspektasi yang realistis. Mengharapkan terlalu banyak dari Si Kecil dapat menimbulkan frustasi bagi keduanya. Dalam tahap ini, validasi Bunda terhadap perasaan Si Kecil sangat penting. Dengan mengakui emosi yang sedang Si Kecil rasakan, Bunda membantu Si Kecil memahami bahwa setiap perasaan adalah normal dan mengajarkan cara yang sehat dalam meresponnya.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '5.png',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $emotal) {
            Emotal::insert($emotal);
            $destinationPath = public_path('img/emosi_mental/' . $emotal['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Emotal/' . $emotal['foto']), $destinationPath);
        }
    }
}