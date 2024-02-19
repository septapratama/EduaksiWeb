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
                'judul' => 'Mengenali Makanan Sehat: Panduan Sederhana untuk Memilih Makanan yang Bergizi',
                'deskripsi' => 'Dalam artikel ini, kita akan membahas tentang cara mengenali makanan sehat dan bergizi. Dengan begitu banyak pilihan makanan di pasaran, seringkali sulit untuk memilih yang terbaik untuk kesehatan kita. Namun, dengan memahami label gizi, memprioritaskan makanan segar dan alami, serta menghindari makanan yang diproses secara berlebihan, kita dapat membuat pilihan makanan yang lebih baik untuk tubuh kita. Dengan panduan sederhana ini, kita dapat membangun pola makan yang seimbang dan mendukung kesehatan secara keseluruhan.',
                'link_video' => Str::random(10),
                'rentang_usia' => '3-5',
                'foto' => '1.jpeg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Peran Penting Aktivitas Fisik dalam Kesehatan: Cara Mendorong Gaya Hidup Aktif untuk Anak-anak dan Remaja',
                'deskripsi' => 'Aktivitas fisik merupakan bagian penting dari gaya hidup sehat, terutama bagi anak-anak dan remaja yang sedang dalam tahap pertumbuhan dan perkembangan. Dalam artikel ini, kita akan membahas tentang peran penting aktivitas fisik dalam kesehatan dan cara mendorong gaya hidup aktif pada anak-anak dan remaja. Orang tua dan pendidik perlu memberikan contoh positif dengan terlibat dalam aktivitas fisik bersama anak-anak, menyediakan kesempatan untuk bermain di luar ruangan, dan mengurangi waktu layar yang berlebihan. Dengan membantu anak-anak mengembangkan kebiasaan hidup aktif sejak dini, kita dapat membantu mereka tumbuh menjadi generasi yang lebih sehat dan kuat.',
                'link_video' => Str::random(10),
                'rentang_usia' => '6-7',
                'foto' => '2.jpeg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Mengatasi Masalah Makan Pada Anak: Tips dan Trik untuk Orang Tua dalam Menangani Picky Eaters',
                'deskripsi' => 'Masalah makan pada anak, seperti picky eaters atau anak yang sulit makan, dapat menjadi tantangan bagi orang tua. Dalam artikel ini, kita akan membahas tentang cara mengatasi masalah makan pada anak. Memberikan pilihan makanan yang sehat dan beragam, melibatkan anak dalam proses memasak dan memilih makanan, serta menciptakan suasana makan yang positif dan menyenangkan dapat membantu mengatasi masalah makan pada anak. Dengan kesabaran, konsistensi, dan pendekatan yang positif, orang tua dapat membantu anak mengembangkan hubungan yang sehat dengan makanan dan membangun kebiasaan makan yang baik sepanjang hidup.',
                'link_video' => Str::random(10),
                'rentang_usia' => '9-11',
                'foto' => '3.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $nutrisi) {
            Nutrisi::insert($nutrisi);
            Storage::disk('nutrisi')->put($nutrisi['foto'], file_get_contents(database_path('seeders/image/Nutrisi/' . $nutrisi['foto'])));
        }
    }
}