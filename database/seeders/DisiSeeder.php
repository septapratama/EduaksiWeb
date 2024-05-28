<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Disi;
use Carbon\Carbon;
class DisiSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'PENGENALAN LITERASI DIGITAL PADA ANAK USIA DINI',
                'deskripsi' => 'Literasi digital pada anak usia dini dipandang sebagai sikap, pengetahuan, dan keterampilan dalam menggunakan media digital yang ada di sekitarnya untuk mencari dan memanfaatkan informasi, belajar, bermain, atau mendapatkan hiburan secara sehat dengan pendampingan dari orang dewasa di sekitarnya. Sikap, pengetahuan dan keterampilan digital ini juga merupakan cikal bakal perkembangan digital kedepannya.
                Tugas kita selanjutnya adalah, perlu membangun kemampuan anak terkait dengan literasi digital seperti halnya berikut ini:
                •	Mampu menggunakan perangkat elektronik untuk mendapatkan informasi.
                •	Memahami informasi bahwa gambar, teks, cerita, dan film di perangkat elektronik memiliki makna.
                •	Mampu menggunakan perangkat elektronik untuk merekam ide, perasaan, kegiatan, atau lingkungan di sekitar mereka.
                Dengan memiliki kemampuan di atas diharapkan dapat membantu beberapa hal sebagaimana di bawah ini:
                •	Dapat digunakan sebagai media belajar bagi anak usia dini
                •	Sebagai sumber belajar untuk mendapatkan informasi dalam mendukung dan mengembangkan rasa ingin tahu anak
                •	Sebagai alat komunikasi yang efektif dan efisien untuk menyampaikan pesan atau informasi
                •	Sebagai media belajar misalnya penggunaan laptop, komputer, ponsel, kamera pada saat bermain peran.
                •	Sebagai sumber belajar misalnya dengan mengajak anak mencari informasi, mendengarkan lagu, melihat video pembelajaran, atau bermain gim untuk mengenal bentuk geometri, dll.
                •	Sebagai alat komunikasi misalnya dengan melaksanakan pembelajaran jarak jauh dengan melakukan panggilan atau konferensi video.
                Literasi digital perlu dikenalkan kepada anak usia dini karena anak memiliki rasa ingin tahu yang tinggi, termasuk terhadap gawai. Gawai memiliki fitur-fitur yang memicu tantangan sekaligus keceriaan bagi anak. Gambar, lagu, gim, dan film dengan suara dan warna menarik menawarkan pengalaman bermain yang berbeda bagi anak. Selain itu, melarang atau menjauhkan anak dari gawai dikhawatirkan justru akan membuat rasa penasaran anak semakin tinggi. Sedangkan mengenalkan anak tentang kapan dan bagaimana menggunakan gawai justru akan membantu anak untuk menggunakan gawai secara aman. Perlu adanya keterlibatan orang tua dalam literasi digital sehat untuk anak melalui pendampingan, sehingga Ketika digunakan dengan tepat, perangkat digital menjadi alat untuk membantu anak belajar sehingga mendukung perkembangan mereka.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'KAPAN MENGENALKAN LITERASI DIGITAL KEPADA ANAK USIA DINI? ',
                'deskripsi' => 'Anak-anak yang terlahir setelah tahun 2011 merupakan generasi yang memiliki karakteristik berbeda dengan anak-anak yang terlahir pada tahun-tahun sebelumnya. Sejak lahir mereka telah terbiasa dengan gawai di lingkungan sekitarnya. Saat ini anak-anak lebih sering melihat ayah dan bundanya memainkan ponsel. Anak-anak lebih suka mendengarkan lagu-lagu atau menonton film anak, atau bermain gim yang diputarkan untuk mereka dengan ponsel, tablet, laptop, dan lain-lain. Bahkan, tidak jarang orang tua menggunakan ponsel untuk menenangkan anak-anak mereka. Sering kali gawai menggantikan peran pengasuhan oleh orang tua. Orang tua yang membiarkan anaknya bermain dengan ponsel menjadi pemandangan yang kerap kita saksikan di sekitar kita.
                Anak butuh bermain menggunakan berbagai benda yang menarik perhatiannya. Gawai yang menawarkan berbagai fitur tentu sangat menarik bagi anak. Kapan dan berapa lama kita bisa memberikan anak kesempatan untuk bermain dengan gawai? 
                •	Pada usia 0-2 tahun sebaiknya anak tidak dikenalkan pada gawai karena sinar pada layar gawai dikhawatirkan membahayakan mata anak dan radiasinya memengaruhi otak anak. 
                •	Pada usia 2-4 tahun anak diperbolehkan menggunakan gawai untuk bermain gim sederhana dengan alokasi waktu maksimal 1 jam dalam sehari. 
                •	Pada usia 4-7 tahun anak diberikan kesempatan untuk beresplorasi dengan pendampingan dari orang tua atau orang dewasa. Sebaiknya anak diberikan peraturan dan batasan waktu dalam menggunakan gawai, yaitu maksimal 2 jam dalam sehari.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'LITERASI DIGITAL DAN HUBUNGANNYA TERHADAP PERILAKU ANAK USIA DINI DI PAUD',
                'deskripsi' => 'Di jaman serba digital seperti sekarang ini siapapun bisa mengakses TV ataupun internet dengan mudah, terlebih anak-anak. Dengan kemudahan mengakses ini, anak-anak tidak mengetahui dampak dari tontonan yang mereka lihat setiap hari, apakah akan mempengaruhi perilaku mereka atau tidak. Disinilah peran orang tua diharapkan menjadi benteng bagi anak mereka dalam memberikan edukasi dampak dari tontonan yang mereka lihat baik dari TV ataupun internet. Karena dengan peran orang tua memberikan edukasi secara sehat, bijak, cerdas, cermat, tepat perihal tontonan yang baik bagi mereka maka akan mengurangi anak-anak yang mengikuti perilaku yang tidak baik dari tontonan tersebut hal inilah yang yang dinamakan literasi digital (). 
                Kemajuan teknologi digital saat ini telah mempengaruhi orang tua dalam mendidik anak. Di zaman yang serba digital seperti ini cara mendidik orang tua pun banyak perubahan yang dahulu lebih suka bermain bersama anak mereka namun saat ini sudah banyak mengalami perubahan dalam mendidik anak contohnya orang tua lebih mudah memberikan dan mengenalkan teknologi kepada anak dengan alasan agar anak bisa diam dan tidak rewel. Cara ini diakui oleh banyak orang tua agar anak-anak mereka tidak rewel dan tetap diam. 
                Namun banyak orang tua yang memberikan kemudahan akses teknologi kepada anak-anak mereka tanpa melakukan pantauan terhadap mereka. Para orang tua sering kali memberikan perangkat elektronik tanpa memberikan batasan akses untuk anak mereka. Tanpa di sadari anak-anak sudah kecanduan gadget. Namun hal ini masih di anggap sepele oleh orang tua, sebab orang tua menganggap bahwa sekarang adalah jaman digital jaman serba canggih, jika tidak menggunakan gadget maka ada anggapan ketinggalan jaman danorang tua belum mengerti bahwa kecanduan gadget sangat berbahaya bagi anak-anak
                Anak-anak yang tidak didampingi dalam penggunaan elektronik lama-kelamaan akan mengalami kecanduan. Dalam kehidupan sehari-hari mereka selalu menggunakan peralatan elektronik tanpa ada batasan. Jika suatu hari orang tua baru menyadari jika perilaku anak mereka menjadi buruk karena peralatan elektronik itu, mereka pasti akan menyitananya. Namun anak yang sudah kecanduan terhadap barang elektronik akan mengamuk jika hal itu dipisahkan oleh mereka. Dan akan mengganggu psikologis mereka dikemudian harinya. Pada kenyataannya, risiko anak-anak yang rentan secara psikologis terhadap hasil negatif diperburuk oleh kecenderungan mereka untuk menghabiskan lebih banyak waktu online tetapi diimbangi dengan tingkat melek huruf yang lebih rendah (bertentangan dengan hubungan langsung dan tidak langsung). Di antara mereka yang tidak rentan, literasi digital terkait lemah dengan hasil negatif. Banyak aspek perkembangan anak yang harus melakukan penyesuaian terhadap lingkungan yang sudah berbasis teknologi. Misalnya berkaitan dengan teknologi digital pada mainan anak, yang mana anak sangat membutuhkan pendampingan orang tua pada anak usia dini dalam penggunaan teknologi digital pada mainan tersebut.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'PENGERTIAN LITERASI DIGITAL DAN UPAYA PENINGKATAN',
                'deskripsi' => 'literasi digital merupakan upaya yang diperlukan individu pada era canggih seperti saat ini untuk menyaring informasi secara akurat. Upaya lain untuk mendukung literasi digital ini adalah penggunaan aplikasi yang tepat dan pemahaman secara mendalam mengenai informasi yang didapatkan tersebut. Mengingat dampak mengenai penyebaran hoax dalam masyarakat sangat memperihatinkan. Literasi yang buruk ternyata dapat berdampak buruk bagi psikologis remaja. Hal tersebut karena usia remaja cenderung labil dan sering menelan mentah-mentah informasi yang didapatkan tanpa mencari tahu kebenaran dan keakuratan dari informasi tersebut.
                Upaya Peningkatan Kemampuan Literasi Digital
                •	Perpusnas
                Program literasi informasi telah menjadi bagian dari program layanan perpustakan di wilayah Indonesia. Dari adanya kemajuan teknologi membuat sumber daya informasi digital semakin melimpah karena banyaknya sumber-sumber yang menyediakan informasi tersebut. Saat ini pemerintah telah ikut berkontribusi dalam upaya peningkatan literasi digital dengan meluncurkan berbagai program.
                •	ePerpus
                ePerpus adalah layanan perpustakaan digital dengan konsep B2B (Business to Business) yang diusung oleh Kompas  Gramedia. ePerpus menawarkan pengelolaan pepustakaan digital untuk sekolah, perusahaan, instansi, hingga komunitas.  https://www.eperpus.com/home/
                •	Gramedia Digital
                Gramedia Digital adalah aplikasi ebook dengan koleksi buku, koran dan majalah terlengkap dari penulis dan penerbit ternama. Gramedia Digital dapat diakses melalui smartphone atau tablet Android ataupun Apple. https://ebooks.gramedia.com/
                Upaya-upaya tersebut dilakukan dengan tujuan dapat memberikan kontribusi positif terhadap peningkatan kemampuan literasi informasi terutama peserta didik yang terbiasa melakukan pencarian informasi melalui Google. Namun, upaya-upaya tersebut tidak boleh berhenti begitu saja, harus dikembangkan sehingga dapat terwujud generasi masa depan yang “handal” dalam budaya membaca, menulis, mengolah, dan mengevaluasi informasi pada era digital ini.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '4.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'PENGARUH LITERASI DIGITAL TERHADAP PSIKOLOGI ANAK',
                'deskripsi' => 'Media digital saat ini memudahkan kita untuk memperoleh informasi secara cepat karena setiap penggunanya dapat saling berbagi informasi. Tidak dapat dibantah bahwa hal tersebut memberikan dampak positif dan dampak negatif kepada penggunanya, terutama yang berusia remaja. Di Indonesia, jumlah pengguna internet didominiasi oleh kalangan remaja sehingga kemungkinan dampak yang paling dirasakan adalah remaja. Menurut Retnowati (2015, dalam Pratiwi) penggunaan internet yang baik dapat meningkatkan prestasi penggunanya, tetapi apabila digunakan secara buruk pasti dapat mengakibatkan efek negatif terhadap diri remaja.
                Contoh yang saat ini sering terjadi adalah kasus pencemaran nama baik, bullying, bahkan prostitusi yang pasti memicu depresi remaja. Mengapa hal tersebut bisa terjadi?
                Karena mereka belum memahami seutuhnya mengenai konsekuensi dari adanya penggunaan media digital. Memang mereka (remaja) telah menguasai literasi berupa kemampuan baca dan tulis, tetapi mereka belum memiliki kemampuan literasi digital.Dalam internet, banyak pengguna yang tidak segan untuk menghina bahkan mengetik tulisan yang bermakna kasar kepada pengguna lain. Itulah contoh dari dampak negatif literasi digital saat ini. Fenomena tersebut apabila diterima oleh remaja yang pada umunya kondisi psikologisnya belum stabil, dapat berpengaruh pada perkembangan emosinya kelak.
                Ketidakmampuan remaja dalam memaknai literasi digital dapat dilihat dari tindakan mereka yang segera berkomentar menghina saat terdapat informasi negatif, lalu apabila terdapat informasi positif mereka langsung membagikannya di akun miliknya. Lalu apa yang harus dilakukan supaya para remaja saat ini tidak mudah depresi saat melakukan literasi digital dengan sosial media? Tentu saja peran orang tua sangatlah penting. Mereka harus cermat untuk mengawasi tingkah laku remaja. Selain itu, para orang tua seharusnya memberikan pemahaman mengenai literasi digital. Jangan sampai adanya kemajuan teknologi ini terutama keberadaan literasi digital ini membuat keadaan psikologis remaja terganggu bahkan hingga depresi. Maka dari itu, yuk jadi pengguna internet yang cerdas!
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '5.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $disi) {
            Disi::insert($disi);
            $destinationPath = public_path('img/digital_literasi/' . $disi['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Disi/' . $disi['foto']), $destinationPath);
        }
    }
}