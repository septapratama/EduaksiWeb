<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Pengasuhan;
use Carbon\Carbon;
class PengasuhanSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pengasuhan Positif: Membangun Karakter Anak yang Kuat',
                'deskripsi' => 'Pengasuhan positif adalah pendekatan yang menekankan pada penguatan perilaku baik daripada menghukum perilaku buruk. Orang tua yang menerapkan pengasuhan positif lebih fokus pada pemberian pujian, penghargaan, dan dukungan emosional untuk mendorong anak-anak mereka bertindak secara bertanggung jawab. Hal ini membantu anak-anak mengembangkan rasa percaya diri, kemandirian, dan kemampuan untuk mengatasi tantangan. Teknik ini juga melibatkan mendengarkan secara aktif dan memberikan respon yang empatik, yang dapat memperkuat hubungan emosional antara orang tua dan anak.
                Selain itu, pengasuhan positif melibatkan pengajaran nilai-nilai penting seperti empati, rasa hormat, dan kerja sama. Orang tua yang menggunakan pendekatan ini sering kali mengajarkan anak mereka tentang konsekuensi alami dan logis dari tindakan mereka, bukan dengan ancaman atau hukuman. Ini membantu anak-anak belajar dari kesalahan mereka dan memahami pentingnya membuat keputusan yang baik. Dengan demikian, mereka tidak hanya belajar untuk berperilaku baik, tetapi juga untuk menjadi individu yang bertanggung jawab dan berintegritas.
                Pengasuhan positif memberikan landasan yang kuat bagi perkembangan anak dengan menekankan pada penguatan karakter dan kemampuan sosial mereka. Dengan fokus pada aspek positif, anak-anak cenderung tumbuh menjadi individu yang percaya diri dan mampu mengelola emosinya dengan baik. Selain itu, mereka belajar untuk menjadi lebih empatik dan mampu bekerja sama dengan orang lain, yang merupakan keterampilan penting untuk kesuksesan di masa depan.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pengaruh Komunikasi Terbuka dalam Pengasuhan Anak',
                'deskripsi' => 'Komunikasi terbuka antara orang tua dan anak sangat penting untuk menciptakan hubungan yang harmonis dan saling percaya. Orang tua yang mendengarkan dengan baik dan memberikan respon yang empatik membantu anak merasa dihargai dan dipahami. Hal ini juga mendorong anak untuk lebih terbuka dalam berbagi perasaan dan masalah yang mereka hadapi. Komunikasi yang efektif melibatkan mendengarkan tanpa menghakimi, mengajukan pertanyaan terbuka, dan memberikan dukungan yang konstruktif.
                Selain itu, komunikasi terbuka memungkinkan orang tua untuk memberikan bimbingan dan nasihat yang diperlukan secara tepat waktu. Ketika anak merasa nyaman berbicara dengan orang tua mereka, mereka lebih mungkin untuk mencari nasihat ketika menghadapi masalah atau membuat keputusan penting. Ini juga membantu mengurangi kemungkinan kesalahpahaman dan konflik, karena anak merasa bahwa mereka memiliki suara dan perasaan mereka diperhitungkan dalam keputusan keluarga.
                Dengan menerapkan komunikasi terbuka, orang tua dapat membantu anak mengembangkan keterampilan komunikasi yang efektif dan membangun hubungan yang kokoh. Komunikasi yang baik antara orang tua dan anak adalah kunci dalam mendukung perkembangan emosional dan sosial anak. Hal ini juga membantu anak merasa lebih aman dan dihargai, yang berkontribusi pada kesejahteraan mereka secara keseluruhan.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Konsistensi dalam Disiplin Anak',
                'deskripsi' => 'Konsistensi dalam disiplin adalah salah satu kunci utama dalam pengasuhan anak. Ketika aturan dan konsekuensi diterapkan secara konsisten, anak-anak belajar memahami batasan dan apa yang diharapkan dari mereka. Hal ini membantu anak merasa aman dan mengetahui bahwa ada struktur dan aturan yang jelas dalam hidup mereka. Konsistensi juga membantu anak memahami bahwa setiap tindakan memiliki konsekuensi, baik positif maupun negatif, yang membantu mereka belajar tanggung jawab.
                Selain itu, konsistensi dalam disiplin membantu menghindari kebingungan dan frustrasi pada anak. Ketika aturan berubah-ubah atau tidak diterapkan dengan konsisten, anak mungkin merasa bingung dan tidak tahu apa yang diharapkan dari mereka. Dengan disiplin yang konsisten, anak-anak belajar mengembangkan rasa disiplin diri dan memahami pentingnya mengikuti aturan. Ini juga membantu mereka belajar untuk mengelola perilaku mereka sendiri dan membuat keputusan yang lebih baik.
                Dengan konsistensi dalam penerapan disiplin, orang tua dapat menciptakan lingkungan yang stabil dan terstruktur bagi anak. Anak-anak yang dibesarkan dengan disiplin yang konsisten cenderung memiliki pemahaman yang lebih baik tentang tanggung jawab dan aturan sosial. Mereka juga cenderung lebih patuh dan mampu mengelola perilaku mereka sendiri, yang penting untuk keberhasilan mereka di masa depan.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Peran Kasih Sayang dalam Pengasuhan Anak',
                'deskripsi' => 'Kasih sayang adalah elemen esensial dalam pengasuhan anak yang membantu membangun rasa aman dan percaya diri pada anak. Melalui pelukan, kata-kata yang lembut, dan perhatian penuh, orang tua dapat menunjukkan kasih sayang mereka. Anak-anak yang merasa dicintai cenderung lebih bahagia, lebih stabil secara emosional, dan lebih mudah membentuk hubungan positif dengan orang lain. Kasih sayang yang konsisten juga membantu mengurangi stres dan kecemasan pada anak.
                Selain itu, kasih sayang membantu dalam perkembangan otak anak, khususnya bagian yang berkaitan dengan emosi dan hubungan sosial. Anak-anak yang menerima kasih sayang yang cukup dari orang tua mereka cenderung memiliki keterampilan sosial yang lebih baik dan lebih mampu mengelola emosi mereka. Kasih sayang juga meningkatkan rasa percaya diri dan harga diri anak, yang penting untuk keberhasilan mereka di berbagai aspek kehidupan.
                Kasih sayang dalam pengasuhan adalah fondasi penting untuk perkembangan emosional dan psikologis anak. Dengan memberikan kasih sayang yang cukup, orang tua dapat membantu anak tumbuh menjadi individu yang sehat secara emosional dan mampu menjalin hubungan sosial yang baik. Anak-anak yang merasa dicintai dan dihargai cenderung lebih bahagia dan lebih mampu menghadapi tantangan hidup.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '4.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Waktu Berkualitas dengan Anak',
                'deskripsi' => 'Menghabiskan waktu berkualitas bersama anak adalah cara efektif untuk memperkuat ikatan antara orang tua dan anak. Kegiatan sederhana seperti bermain, membaca bersama, atau berbicara tentang hari mereka dapat membuat anak merasa diperhatikan dan dihargai. Waktu berkualitas juga memberikan kesempatan bagi orang tua untuk mengenal anak mereka lebih baik dan memahami kebutuhan serta minat mereka. Ini juga membantu anak merasa lebih aman dan dicintai.

                Selain itu, waktu berkualitas membantu anak mengembangkan keterampilan sosial dan emosional yang penting. Melalui interaksi yang positif dan bermakna dengan orang tua, anak belajar tentang empati, kerja sama, dan cara mengelola emosi mereka. Kegiatan bersama juga dapat menjadi kesempatan bagi orang tua untuk mengajarkan nilai-nilai penting dan memberikan contoh perilaku yang baik. Ini semua berkontribusi pada perkembangan anak yang sehat dan seimbang.
                Waktu berkualitas dengan anak tidak hanya memperkuat hubungan antara orang tua dan anak, tetapi juga membantu dalam perkembangan sosial dan emosional anak. Dengan meluangkan waktu bersama secara teratur, orang tua dapat menciptakan kenangan indah dan memberikan dukungan yang penting bagi pertumbuhan anak. Anak-anak yang menghabiskan waktu berkualitas dengan orang tua mereka cenderung lebih bahagia, lebih percaya diri, dan lebih siap menghadapi tantangan hidup.
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
        foreach ($this->dataSeeder() as $pengasuhan) {
            Pengasuhan::insert($pengasuhan);
            $destinationPath = public_path('img/pengasuhan/' . $pengasuhan['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Pengasuhan/' . $pengasuhan['foto']), $destinationPath);
        }
    }
}