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
                'judul' => 'Mengenal Bahaya Malware: Pentingnya Memahami Ancaman Keamanan Digital',
                'deskripsi' => 'Dalam artikel ini, kita akan membahas tentang ancaman malware dalam lingkungan digital. Malware merupakan perangkat lunak berbahaya yang dapat merusak sistem, mencuri informasi pribadi, dan bahkan mengancam keamanan finansial pengguna. Penting bagi kita untuk memahami jenis-jenis malware yang ada, seperti virus, worm, trojan, dan ransomware, serta cara untuk melindungi diri dari serangan malware ini. Dengan meningkatkan pemahaman tentang ancaman malware, kita dapat mengambil langkah-langkah preventif yang diperlukan untuk menjaga keamanan online kita.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpeg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Menjaga Anak-anak dari Bahaya Cyberbullying: Peran Orang Tua dalam Mengasah Digital Literacy',
                'deskripsi' => 'Cyberbullying merupakan salah satu ancaman serius dalam dunia digital, terutama bagi anak-anak dan remaja. Dalam artikel ini, kita akan membahas tentang pentingnya peran orang tua dalam melindungi anak-anak dari bahaya cyberbullying. Orang tua perlu terlibat aktif dalam mendidik anak-anak tentang pentingnya etika online, mengajarkan mereka cara berinteraksi secara aman di media sosial, dan memberikan dukungan emosional jika mereka menjadi korban cyberbullying. Dengan meningkatkan digital literacy anak-anak dan mendukung mereka dalam menghadapi ancaman online, kita dapat menciptakan lingkungan online yang lebih aman dan positif bagi generasi mendatang.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpeg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Cara Mengenali dan Mencegah Serangan Phishing: Langkah-langkah Praktis untuk Keamanan Online Anda',
                'deskripsi' => 'Phishing adalah teknik penipuan online yang bertujuan untuk mencuri informasi pribadi pengguna, seperti kata sandi, informasi kartu kredit, atau data keuangan lainnya. Dalam artikel ini, kita akan membahas cara mengenali dan mencegah serangan phishing. Langkah-langkah seperti memeriksa URL yang mencurigakan, tidak mengklik tautan dari email yang tidak dikenal, dan menggunakan alat keamanan seperti perangkat lunak antivirus dan filter spam dapat membantu melindungi diri dari serangan phishing. Dengan meningkatkan kesadaran tentang teknik phishing dan mengambil langkah-langkah preventif yang sesuai, kita dapat mengurangi risiko menjadi korban penipuan online ini.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpg',
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