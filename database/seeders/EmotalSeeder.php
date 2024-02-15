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
                'judul' => 'Mengenal Emosi: Pentingnya Memahami Peran dan Dampaknya dalam Kesejahteraan Mental',
                'deskripsi' => 'Dalam artikel ini, kita akan membahas tentang pentingnya memahami emosi dalam konteks kesejahteraan mental. Emosi merupakan bagian alami dari pengalaman manusia yang mempengaruhi pikiran, perilaku, dan interaksi sosial kita. Memahami peran dan dampak emosi dapat membantu kita mengelola stres, mengatasi tantangan kehidupan sehari-hari, dan membangun hubungan yang sehat dengan diri sendiri dan orang lain. Dengan meningkatkan kesadaran tentang emosi kita, kita dapat memperkuat kesejahteraan mental dan meningkatkan kemampuan kita dalam mengatasi berbagai situasi kehidupan.',
                'link_video' => Str::random(10),
                'rentang_usia' => '3-5',
                'foto' => '1.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Strategi Mengatasi Stres: Cara Efektif Mengelola Emosi Negatif dalam Situasi Tantangan',
                'deskripsi' => 'Stres adalah bagian tak terhindarkan dari kehidupan, tetapi cara kita meresponsnya dapat membuat perbedaan besar dalam kesejahteraan mental kita. Dalam artikel ini, kita akan membahas tentang strategi mengatasi stres dan mengelola emosi negatif. Mulai dari teknik relaksasi seperti meditasi dan pernapasan dalam, hingga mengubah pola pikir dan mengembangkan rasa optimisme, ada banyak cara yang dapat membantu kita menghadapi stres dengan lebih baik. Dengan mempraktikkan strategi ini secara konsisten, kita dapat meningkatkan ketahanan kita terhadap tekanan hidup dan menjaga kesejahteraan mental kita.',
                'link_video' => Str::random(10),
                'rentang_usia' => '6-7',
                'foto' => '2.jpg',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'uuid' =>  Str::uuid(),
                'judul' => 'Pentingnya Dukungan Emosional: Peran Keluarga dan Teman dalam Meningkatkan Kesejahteraan Mental',
                'deskripsi' => 'Dalam artikel ini, kita akan membahas tentang pentingnya dukungan emosional dari keluarga dan teman dalam meningkatkan kesejahteraan mental. Mendapatkan dukungan dari orang-orang terdekat dapat membantu kita mengatasi stres, merasa lebih dihargai dan diterima, serta meningkatkan rasa koneksi dan keterikatan sosial kita. Oleh karena itu, penting untuk membangun dan merawat hubungan yang positif dengan orang-orang di sekitar kita, serta mencari bantuan dan dukungan saat kita membutuhkannya. Dengan memiliki jaringan dukungan yang kuat, kita dapat merasa lebih didukung dan mampu mengatasi tantangan kehidupan dengan lebih baik.',
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
        foreach ($this->dataSeeder() as $emotal) {
            Emotal::insert($emotal);
            Storage::disk('emotal')->put($emotal['foto'], file_get_contents(database_path('seeders/image/Emotal/' . $emotal['foto'])));
        }
    }
}