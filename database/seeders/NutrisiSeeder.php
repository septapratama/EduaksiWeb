<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Nutrisi;
use Carbon\Carbon;
class NutrisiSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Nutrisi Penting untuk Tumbuh Kembang Anak: Usia 1-3 Tahun',
                'deskripsi' => 'Tumbuh kembang anak merupakan fase yang krusial dalam kehidupan mereka. Nutrisi yang tepat pada tahap-tahap awal kehidupan akan memainkan peran besar dalam membentuk kesehatan dan perkembangan anak-anak. Fokus utama pada usia 1-3 tahun sangat penting karena ini adalah periode pertumbuhan dan perkembangan yang pesat.
                Protein menjadi fokus utama pada periode ini karena penting untuk pertumbuhan jaringan dan otot pada anak-anak. Sumber protein yang baik meliputi daging tanpa lemak, ikan, telur, kacang-kacangan, dan produk susu seperti yogurt atau keju rendah lemak. Selain itu, karbohidrat kompleks seperti roti gandum, nasi merah, atau pasta gandum utuh sangat diperlukan sebagai sumber energi yang bertahan lama.
                Lemak sehat juga penting untuk perkembangan otak dan sistem saraf. Alpukat, kacang-kacangan, ikan berlemak seperti salmon, dan minyak zaitun merupakan sumber lemak sehat yang baik. Selain itu, vitamin dan mineral seperti vitamin A, C, D, kalsium, dan zat besi harus dipenuhi melalui makanan seimbang seperti buah-buahan, sayuran berwarna-warni, dan produk susu.
                Ketika anak-anak memasuki tahap usia selanjutnya, penting untuk terus memperhatikan nutrisi mereka. Meskipun kebutuhan nutrisi mungkin berubah seiring bertambahnya usia, prinsip-prinsip dasar tetap sama. Pastikan anak-anak menerima makanan yang seimbang dan variasi untuk mendukung pertumbuhan dan perkembangan yang optimal.
                Dengan memberikan nutrisi yang tepat pada tahap-tahap awal kehidupan, kita dapat memberikan fondasi yang kuat bagi kesehatan dan kesejahteraan anak-anak kita. Penting untuk mengajarkan pola makan yang sehat sejak dini agar mereka dapat membawa kebiasaan ini ke dalam kehidupan dewasa mereka. Dengan demikian, kita dapat membantu mereka tumbuh menjadi generasi yang sehat dan kuat.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Peran Orang Tua dalam mencukupi Nutrisi Anak',
                'deskripsi' => 'Memastikan anak-anak menerima nutrisi yang tepat adalah salah satu tugas penting sebagai orang tua. Nutrisi yang memadai tidak hanya mendukung pertumbuhan fisik, tetapi juga mendukung perkembangan otak dan sistem kekebalan tubuh mereka. Dalam upaya untuk memastikan anak-anak tumbuh menjadi individu yang sehat dan kuat, ada beberapa nutrisi kunci yang harus diperhatikan.
                1. Kalsium untuk Tulang yang Kuat: Kalsium adalah nutrisi penting yang diperlukan untuk pertumbuhan tulang dan gigi yang sehat pada anak-anak. Anak-anak membutuhkan asupan kalsium yang cukup setiap hari untuk mendukung pertumbuhan tulang yang optimal. Sumber kalsium yang baik meliputi produk susu, seperti susu, yogurt, dan keju rendah lemak, serta sumber nabati seperti sayuran berdaun hijau, kacang-kacangan, dan tahu.
                2. Zat Besi untuk Mencegah Anemia: Zat besi merupakan komponen penting dari sel darah merah yang membawa oksigen ke seluruh tubuh. Anak-anak yang kekurangan zat besi dapat mengalami anemia, yang dapat memengaruhi konsentrasi, energi, dan daya tahan tubuh mereka. Sumber zat besi yang baik termasuk daging tanpa lemak, unggas, ikan, biji-bijian, dan sayuran berdaun hijau.
                3. Vitamin dan Mineral untuk Sistem Kekebalan Tubuh yang Kuat: Vitamin dan mineral seperti vitamin C, vitamin D, dan seng memainkan peran penting dalam mendukung sistem kekebalan tubuh anak-anak. Mereka membantu melawan infeksi dan menjaga kesehatan secara keseluruhan. Pastikan anak-anak mendapatkan cukup vitamin dan mineral melalui makanan seimbang, termasuk buah-buahan, sayuran, biji-bijian, dan produk susu.
                4. Lemak Sehat untuk Perkembangan Otak: Lemak sehat, terutama asam lemak omega-3, sangat penting untuk perkembangan otak dan fungsi kognitif pada anak-anak. Makanan seperti salmon, sarden, kacang-kacangan, dan biji-bijian merupakan sumber lemak sehat yang baik yang dapat membantu mendukung perkembangan otak yang optimal.
                5. Air untuk Hidrasi yang Baik: Terakhir, tetapi tidak kalah pentingnya, adalah pentingnya memastikan anak-anak tetap terhidrasi dengan cukup air. Air membantu menjaga suhu tubuh yang stabil, mengangkut nutrisi ke seluruh tubuh, dan mengeluarkan racun dari tubuh. Pastikan anak-anak minum air secara teratur sepanjang hari, terutama setelah beraktivitas fisik atau saat cuaca panas.
                Dengan memperhatikan asupan nutrisi yang tepat, kita dapat membantu memastikan anak-anak tumbuh menjadi individu yang sehat, bahagia, dan kuat. Memberikan makanan yang seimbang dan mendukung kebiasaan hidup sehat sejak dini merupakan investasi penting untuk masa depan kesehatan dan kesejahteraan mereka.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Mengajarkan Anak-Anak tentang Pola Makan Sehat: Fondasi untuk Kesehatan Seumur Hidup',
                'deskripsi' => 'Memberikan pendidikan tentang pola makan sehat kepada anak-anak merupakan investasi berharga untuk kesehatan mereka seumur hidup. Pola makan yang baik dan seimbang tidak hanya mendukung pertumbuhan dan perkembangan fisik mereka, tetapi juga membangun kebiasaan yang akan mereka bawa hingga dewasa. Berikut adalah beberapa alasan mengapa penting untuk mengajarkan anak-anak tentang pola makan sehat sejak dini.
                1. Membentuk Kebiasaan Sehat: Kebiasaan makan yang sehat yang diajarkan sejak dini cenderung bertahan hingga masa dewasa. Dengan mengajarkan anak-anak tentang makanan sehat dan pentingnya nutrisi, kita membantu mereka membentuk kebiasaan yang akan mendukung kesehatan mereka seumur hidup.
                2. Mengoptimalkan Pertumbuhan dan Perkembangan: Anak-anak membutuhkan nutrisi yang tepat untuk mendukung pertumbuhan dan perkembangan mereka yang pesat. Dengan memberikan makanan yang seimbang, kita memastikan bahwa mereka mendapatkan semua nutrisi yang diperlukan untuk tubuh dan otak mereka berkembang dengan baik.
                3. Mempromosikan Kesehatan Mental: Pola makan yang sehat tidak hanya berdampak pada kesehatan fisik, tetapi juga pada kesehatan mental anak-anak. Makanan yang sehat dapat meningkatkan suasana hati, energi, dan konsentrasi mereka, yang semuanya penting untuk belajar dan bermain dengan baik.
                4. Membantu Menghindari Masalah Kesehatan: Kebiasaan makan yang buruk pada masa kanak-kanak dapat meningkatkan risiko masalah kesehatan seperti obesitas, diabetes, dan penyakit jantung di kemudian hari. Dengan mengajarkan anak-anak untuk memilih makanan yang sehat sejak dini, kita membantu mengurangi risiko ini.
                5. Membuka Wawasan tentang Makanan: Mengajarkan anak-anak tentang makanan sehat juga membuka wawasan mereka tentang berbagai jenis makanan dan manfaatnya. Ini dapat membantu mereka menjadi lebih terbuka terhadap mencoba makanan baru dan mengembangkan preferensi makanan yang sehat.
                6. Melibatkan Mereka dalam Proses Makan: Melibatkan anak-anak dalam memilih dan memasak makanan juga merupakan cara yang bagus untuk mengajarkan mereka tentang pola makan sehat. Ini dapat memberi mereka rasa tanggung jawab atas keputusan makanan mereka dan membantu mereka memahami asal-usul makanan.
                Dengan memberikan pendidikan tentang pola makan sehat sejak dini, kita memberikan anak-anak alat yang mereka butuhkan untuk hidup sehat seumur hidup. Ini adalah investasi penting dalam kesehatan dan kesejahteraan masa depan mereka.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Strategi Efektif Mengatasi Pemilihan Makanan pada Anak-Anak',
                'deskripsi' => 'Masalah pemilihan makanan pada anak-anak sering menjadi tantangan bagi orang tua. Anak-anak cenderung memiliki preferensi makanan yang tertentu dan seringkali menolak makanan sehat. Namun, dengan menggunakan strategi yang tepat, kita dapat membantu anak-anak mengembangkan kebiasaan makan yang sehat. Berikut adalah beberapa strategi efektif yang dapat digunakan untuk mengatasi masalah pemilihan makanan pada anak-anak.
                1. Berikan Pilihan yang Sehat: Berikan anak-anak pilihan makanan yang sehat, tetapi tetap memberi mereka kendali atas pilihan mereka. Misalnya, tawarkan beberapa jenis buah atau sayuran yang berbeda dan biarkan mereka memilih mana yang mereka sukai.
                2. Libatkan Anak-Anak dalam Proses Memasak: Libatkan anak-anak dalam proses memasak makanan. Biarkan mereka membantu memilih resep, memasak makanan, dan menyiapkan hidangan. Ini dapat membuat mereka lebih tertarik untuk mencoba makanan yang mereka bantu memasak.
                3. Jadikan Makanan Menyenangkan: Buat makanan menjadi pengalaman yang menyenangkan dengan menciptakan presentasi yang menarik dan menciptakan tema makanan yang kreatif. Misalnya, buat bentuk-bentuk lucu dari buah atau sayuran atau berikan nama yang menarik pada hidangan.
                4. Jangan Paksa atau Ancam: Hindari memaksa atau mengancam anak-anak untuk makan makanan yang mereka tidak sukai. Ini hanya akan menciptakan asosiasi negatif dengan makanan tersebut dan dapat memperburuk masalah pemilihan makanan.
                5. Beri Contoh Positif: Beri contoh pola makan yang sehat dengan makan makanan yang sehat dan beragam di depan anak-anak. Mereka cenderung meniru perilaku orang dewasa di sekitar mereka, jadi menjadi contoh yang baik dapat membantu mereka mengembangkan kebiasaan makan yang sehat.
                6. Bersabar dan Konsisten: Ingatlah bahwa mengubah kebiasaan makan anak-anak memerlukan waktu dan kesabaran. Tetaplah konsisten dalam menawarkan makanan yang sehat dan bersabarlah saat anak-anak mencoba makanan baru.
                7. Berbicara tentang Manfaat Makanan: Ajak anak-anak berbicara tentang manfaat makanan yang sehat, seperti memberi energi, memperkuat tulang, atau membuat kulit mereka bersinar. Ini dapat membantu mereka memahami mengapa makanan sehat penting untuk tubuh mereka.
                Dengan menggunakan strategi ini secara konsisten, kita dapat membantu anak-anak mengatasi masalah pemilihan makanan dan mengembangkan kebiasaan makan yang sehat sejak dini. Ingatlah bahwa setiap anak memiliki preferensi makanan yang unik, jadi penting untuk bersabar dan fleksibel dalam pendekatan kita.
                ',
                'rentang_usia' => '0-3 tahun',
                'foto' => '4.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Memperkenalkan Anak-Anak pada Variasi Makanan Sehat Sejak Dini',
                'deskripsi' => 'Memperkenalkan anak-anak pada variasi makanan sehat sejak dini adalah langkah penting dalam membentuk kebiasaan makan yang sehat seumur hidup. Anak-anak yang terbiasa dengan berbagai jenis makanan cenderung memiliki pola makan yang lebih seimbang dan mendapatkan nutrisi yang lebih baik daripada mereka yang terbatas pada beberapa pilihan makanan saja. Berikut adalah beberapa alasan mengapa penting untuk memperkenalkan anak-anak pada variasi makanan sehat sejak dini:
                1. Meningkatkan Asupan Nutrisi: Memperkenalkan anak-anak pada berbagai jenis makanan sehat memberi mereka akses ke nutrisi yang beragam. Buah-buahan, sayuran, biji-bijian, dan protein sehat semuanya memiliki nutrisi yang berbeda-beda yang diperlukan untuk pertumbuhan dan perkembangan yang optimal.
                2. Mengembangkan Preferensi Makanan yang Sehat: Membiasakan anak-anak untuk mencoba makanan baru membantu mereka mengembangkan preferensi makanan yang sehat. Dengan memberikan mereka kesempatan untuk mencicipi berbagai rasa, tekstur, dan warna makanan, kita dapat membantu mereka mengembangkan selera yang beragam.
                3. Mencegah Kecenderungan Picky Eater: Anak-anak yang terbiasa dengan variasi makanan sejak dini cenderung memiliki kecenderungan yang lebih rendah untuk menjadi picky eater. Mereka lebih terbuka terhadap mencoba makanan baru dan tidak terlalu terikat pada beberapa jenis makanan saja.
                4. Mendukung Perkembangan Kognitif: Nutrisi yang beragam dari berbagai jenis makanan sehat mendukung perkembangan kognitif anak-anak. Nutrisi seperti asam lemak omega-3, vitamin, dan mineral penting untuk perkembangan otak yang optimal.
                Dengan memperkenalkan anak-anak pada variasi makanan sehat sejak dini, kita dapat membantu mereka membentuk kebiasaan makan yang sehat yang akan bertahan sepanjang hidup mereka. Memberikan mereka akses ke nutrisi yang beragam, mengembangkan selera yang beragam, dan mencegah kecenderungan picky eater adalah langkah penting dalam memastikan bahwa anak-anak tumbuh menjadi individu yang sehat dan kuat.
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
        foreach ($this->dataSeeder() as $nutrisi) {
            Nutrisi::insert($nutrisi);
            $destinationPath = public_path('img/nutrisi/' . $nutrisi['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Nutrisi/' . $nutrisi['foto']), $destinationPath);
        }
    }
}