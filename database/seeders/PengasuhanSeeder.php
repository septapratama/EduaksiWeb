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
                'judul' => 'Mendukung Perkembangan Bayi Anda: Panduan Pengasuhan untuk Orang Tua Baru',
                'deskripsi' => 'Bayi membutuhkan perawatan khusus yang sesuai dengan tahap perkembangan mereka. Dalam artikel ini, kita akan membahas tentang panduan pengasuhan untuk orang tua baru dalam mendukung perkembangan bayi mereka. Hal-hal seperti memberikan ASI eksklusif, menciptakan rutinitas tidur yang nyaman, dan memberikan stimulasi sensorik yang sesuai dapat membantu mendukung perkembangan fisik, mental, dan emosional bayi. Dengan memahami kebutuhan bayi dan memberikan perawatan yang sesuai, orang tua dapat membantu bayi tumbuh menjadi anak yang sehat dan bahagia.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Mengasah Kemandirian Anak Prasekolah: Strategi untuk Mengembangkan Keterampilan Hidup yang Penting',
                'deskripsi' => 'Anak prasekolah sedang dalam fase di mana mereka mulai mengembangkan kemandirian dan keterampilan hidup yang penting. Dalam artikel ini, kita akan membahas tentang strategi untuk mengasah kemandirian anak prasekolah. Memberikan kesempatan bagi anak untuk melakukan tugas-tugas sederhana sendiri, memberikan pujian dan dukungan atas usaha mereka, serta memberikan batasan yang jelas dan konsisten dapat membantu mengembangkan kemandirian dan rasa percaya diri pada anak. Dengan membantu anak mengembangkan kemandirian sejak dini, kita dapat memberikan pondasi yang kuat bagi kesuksesan mereka di masa depan.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Membimbing Remaja Menuju Kemandirian: Cara Orang Tua Mengajarkan Tanggung Jawab dan Keterampilan Hidup',
                'deskripsi' => 'Remaja memasuki fase di mana mereka mulai mencari identitas dan mengembangkan kemandirian mereka. Dalam artikel ini, kita akan membahas tentang cara orang tua dapat membimbing remaja menuju kemandirian. Memberikan tanggung jawab yang sesuai dengan usia, melibatkan mereka dalam pengambilan keputusan keluarga, dan memberikan dukungan serta arahan yang tepat dapat membantu remaja mengembangkan kemandirian dan tanggung jawab yang diperlukan untuk masa depan mereka. Dengan pendekatan yang tepat, orang tua dapat membantu remaja melewati masa transisi ini dengan lancar dan mengembangkan keterampilan hidup yang penting untuk sukses di masa dewasa.',
                'link_video' => Str::random(10),
                'rentang_usia' => '0-3 tahun',
                'foto' => '3.jpeg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $pengasuhan) {
            Pengasuhan::insert($pengasuhan);
            Storage::disk('pengasuhan')->put($pengasuhan['foto'], file_get_contents(database_path('seeders/image/Pengasuhan/' . $pengasuhan['foto'])));
        }
    }
}