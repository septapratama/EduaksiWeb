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
                'judul' => 'Kebangkitan dan Kejatuhan Adolf Hitler: Jalan Menuju Kehancuran Seorang Diktator',
                'deskripsi' => 'Adolf Hitler, sosok yang kontroversial dan memilukan dalam sejarah dunia, telah meninggalkan jejak yang tak terhapuskan dalam ingatan umat manusia. Kehidupannya yang penuh gejolak menggambarkan bagaimana seorang individu bisa meraih kekuasaan mutlak, tetapi pada akhirnya dihancurkan oleh ambisi dan keputusasaan.
                Adolf Hitler lahir pada tanggal 20 April 1889, di Braunau am Inn, Austria. Awal kehidupannya dipenuhi dengan kegagalan dan kesulitan, tetapi keinginannya untuk memperbaiki keadaan Jerman setelah kekalahan dalam Perang Dunia Pertama membawa dia ke panggung politik. Melalui Partai Pekerja Jerman yang kemudian berganti nama menjadi Partai Nazi, Hitler mulai membangun basis pengikutnya dengan retorika anti-Semitik, nasionalis, dan revanchisme yang membara.
                Puncak kebangkitan Hitler datang pada tahun 1933 ketika dia diangkat menjadi Kanselir Jerman. Pada tahun-tahun berikutnya, dia mengkonsolidasikan kekuasaannya dan menghilangkan semua oposisi politik, mengubah Jerman menjadi negara otoriter yang dikuasai oleh kekerasan dan propaganda.
                Namun, kekuasaan absolut Hitler juga membawanya menuju kehancuran. Kegilaan absolutisme dan ambisinya untuk menguasai Eropa membawanya terlibat dalam Perang Dunia Kedua, konflik yang akhirnya menjadi akhir dari rezim Nazi. Kekalahan bertubi-tubi yang diderita oleh pasukan Jerman membawa kehancuran bagi negara dan rakyatnya.
                Pada tanggal 30 April 1945, dengan pasukan Sekutu yang mengepung Berlin, Adolf Hitler mengakhiri hidupnya dengan bunuh diri di bunker Führerbunker di Berlin. Kematian Hitler menandai akhir dari era kegelapan dan kekejaman yang disebabkan oleh rezim Nazi.
                Kisah Adolf Hitler adalah peringatan yang menakutkan tentang bahaya fanatisme, kekuasaan absolut, dan ketidakadilan. Kehidupannya mengajarkan kita pentingnya untuk tetap waspada terhadap kediktatoran dan untuk memperjuangkan nilai-nilai demokrasi, keadilan, dan perdamaian. Sejarah Hitler juga mengingatkan kita bahwa, meskipun seseorang bisa meraih kekuasaan yang besar, tetapi pada akhirnya, kekuasaan itu juga bisa menjadi penyebab kehancuran dirinya sendiri. Oleh karena itu, penting bagi kita semua untuk belajar dari kesalahan masa lalu dan berusaha mencegah kebangkitan rezim otoriter di masa depan.
                ',
                'kategori'=> 'disi',
                'link_video' => 'https://www.youtube.com/embed/uN4AaKW1vEk?si=55T8JSODLjAgwEIe',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Luka Perang Dunia II: Menjelajahi Warisan Rezim Nazi di Eropa',
                'deskripsi' => 'Perang Dunia II, konflik terbesar dalam sejarah manusia, meninggalkan luka yang mendalam di seluruh Eropa, baik secara fisik maupun emosional. Salah satu aspek yang sangat mempengaruhi benua ini adalah warisan dari rezim Nazi Jerman yang dipimpin oleh Adolf Hitler. Meskipun lebih dari tujuh dekade telah berlalu sejak perang berakhir, jejak-jejak rezim Nazi masih terlihat di berbagai penjuru Eropa, mengingatkan dunia akan pahitnya masa lalu dan pentingnya menjaga perdamaian dan toleransi.
                Di seluruh Eropa, terdapat banyak sisa-sisa bangunan dan struktur yang mengingatkan kita pada kekuasaan Nazi. Contohnya adalah kamp-kamp konsentrasi seperti Auschwitz di Polandia, Buchenwald di Jerman, dan Dachau di Austria, di mana jutaan orang Yahudi dan non-Yahudi tewas dalam pembantaian sistematis yang diperintahkan oleh rezim Nazi. Sisa-sisa kamp-kamp ini menjadi saksi bisu dari kekejaman yang tak terlupakan yang terjadi selama Holocaust.
                Selain kamp-kamp konsentrasi, masih ada pula monumen, patung, dan simbol-simbol lain yang dibangun oleh rezim Nazi sebagai bagian dari propaganda mereka. Contoh terkenal termasuk Patung Kemenangan di Berlin, yang awalnya dibangun oleh rezim Nazi untuk memperingati kemenangan mereka yang tak terelakkan.
                Selain luka fisik, pengaruh rezim Nazi juga meninggalkan luka emosional yang mendalam di seluruh Eropa. Trauma yang diakibatkan oleh Holocaust dan kekejaman perang masih dirasakan oleh banyak orang, terutama oleh keluarga yang kehilangan orang yang mereka cintai dalam kejahatan yang tidak manusiawi.Perasaan takut, ketakutan, dan kecurigaan juga masih terasa di beberapa negara Eropa, terutama di antara komunitas minoritas yang menjadi sasaran utama kebijakan diskriminatif rezim Nazi.
                Meskipun luka-luka ini masih ada, mereka juga menjadi pengingat bagi kita semua tentang pentingnya mempelajari sejarah dan memastikan bahwa tragedi semacam itu tidak pernah terulang lagi. Menghormati korban dan memperingatinya adalah tanggung jawab bersama kita sebagai manusia.
                Pendidikan tentang Holocaust dan kekejaman rezim Nazi penting untuk mencegah intoleransi, rasisme, dan ekstremisme yang mungkin muncul di masa depan. Melalui pemahaman yang lebih baik tentang sejarah, kita dapat membangun masyarakat yang lebih inklusif, berempati, dan damai.
                Dengan menjelajahi warisan rezim Nazi di Eropa, kita diingatkan akan kejahatan manusia yang paling gelap dan kita diberi kesempatan untuk berkomitmen untuk mencegahnya terulang di masa depan.
                ',
                'kategori'=> 'disi',
                'link_video' => 'https://www.youtube.com/embed/6XnsYZxH2nI?si=YOCFX4PXjj7lbYYx',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Melampaui Medan Perang: Dampak Sosial dan Budaya Era Nazi',
                'deskripsi' => 'Era Nazi di Jerman tidak hanya menandai periode perang dan kehancuran fisik, tetapi juga menyebabkan dampak yang mendalam pada masyarakat dan budaya. Meskipun kebijakan politik dan militer menjadi sorotan utama dalam sejarah Nazi, penting untuk diakui bahwa dampaknya juga merasuk ke dalam struktur sosial dan budaya yang lebih luas. Dalam artikel ini, kita akan mengeksplorasi beberapa aspek dari dampak sosial dan budaya dari masa kekuasaan Nazi.
                1. Manipulasi Ideologi dan Propaganda Salah satu ciri khas rezim Nazi adalah penggunaan propaganda yang luas untuk memanipulasi pemikiran masyarakat. Melalui kontrol yang ketat atas media dan institusi pendidikan, rezim Nazi berhasil menanamkan ideologi rasial dan kebangsaan yang merusak dalam pikiran banyak orang Jerman. Konsep superioritas ras Arya dan demonisasi terhadap kelompok-kelompok yang dianggap tidak sesuai, seperti Yahudi, Romani, dan homoseksual, menjadi terintegrasi ke dalam budaya sehari-hari. Propaganda tersebut menciptakan polarisasi sosial yang mendalam dan memecah belah masyarakat.
                2. Penganiayaan Terhadap Minoritas Dampak sosial paling mengerikan dari era Nazi adalah penganiayaan yang sistematis terhadap minoritas, terutama Yahudi. Undang-undang rasial Nuremberg dan program eugenik seperti program eutanasia mengekang kebebasan individu dan menghilangkan hak-hak mereka secara bertahap. Pembersihan etnis dan genosida yang terjadi di kamp-kamp konsentrasi menjadi contoh paling ekstrim dari bagaimana pemerintahan Nazi secara langsung menghancurkan kelompok-kelompok minoritas.
                3. Perubahan dalam Struktur Keluarga dan Masyarakat Pemerintahan Nazi juga memiliki dampak yang signifikan pada struktur keluarga dan masyarakat. Program-program eugenik mendorong kebijakan-kebijakan sterilisasi dan pernikahan yang didasarkan pada kriteria rasial tertentu. Selain itu, penindasan politik dan keberadaan konstanta dalam ketakutan menyebabkan banyak keluarga hidup dalam ketidakstabilan dan kecemasan yang konstan. Hal ini memicu perubahan dramatis dalam pola-pola keluarga dan interaksi sosial.
                4. Warisan Trauma dan Refleksi Pasca-Perang Meskipun kejatuhan rezim Nazi menandai akhir dari era kegelapan ini, dampaknya terus dirasakan jauh setelah perang berakhir. Generasi yang selamat dari Holocaust, bersama dengan keturunan mereka, mewarisi trauma psikologis yang mendalam. Selain itu, refleksi tentang masa lalu Nazi menjadi bagian integral dari budaya Jerman pasca-perang. Inisiatif pendidikan dan memorial bertujuan untuk memperingatkan generasi mendatang tentang bahaya intoleransi dan memastikan bahwa kengerian masa lalu tidak terlupakan.
                Melalui pemahaman yang lebih dalam tentang dampak sosial dan budaya era Nazi, kita dapat memahami betapa pentingnya mempertahankan nilai-nilai kemanusiaan, toleransi, dan kedamaian dalam masyarakat kita saat ini. Sejarah Nazi harus dijadikan pengingat yang kuat tentang bahaya ideologi ekstrem dan kekuatan solidaritas dan empati dalam membangun masa depan yang lebih baik.
                ',
                'kategori'=> 'disi',
                'link_video' => 'https://www.youtube.com/embed/llEXqB4YyiE?si=bnzlQTcFZVypMdGH',
                'foto' => '3.png',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $artikel) {
            Artikel::insert($artikel);
            Storage::disk('artikel')->put($artikel['foto'], file_get_contents(database_path('seeders/image/Artikel/' . $artikel['foto'])));
            copy(database_path('seeders/image/Artikel/' . $artikel['foto']), public_path('img/artikel/' . $artikel['foto']));
        }
    }
}