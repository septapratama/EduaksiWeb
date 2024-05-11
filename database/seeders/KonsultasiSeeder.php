<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Konsultasi;
use Carbon\Carbon;
class KonsultasiSeeder extends Seeder
{
    private function dataSeeder() : array
    {
        return [
            [
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Konsultasi1',
                'jenis_kelamin'=>'laki-laki',
                'kategori'=>'psikolog',
                'no_telpon'=>'0852'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'email'=>"KonsultaTesting1@gmail.com",
                'foto'=>'1.jpg',
            ],
            [
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Konsultasi2',
                'jenis_kelamin'=>'perempuan',
                'kategori'=>'anak',
                'no_telpon'=>'0852'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'email'=>"KonsultaTesting2@gmail.com",
                'foto'=>'2.jpg',
            ],
            [
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Konsultasi3',
                'jenis_kelamin'=>'laki-laki',
                'kategori'=>'gigi',
                'no_telpon'=>'0852'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'email'=>"KonsultaTesting3@gmail.com",
                'foto'=>'3.jpg',
            ],
        ];
    }
    public function run(): void
    {
        foreach ($this->dataSeeder() as $konsultasi) {
            Konsultasi::insert($konsultasi);
            $destinationPath = public_path('img/konsultasi/' . $konsultasi['foto']);
            $directory = dirname($destinationPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            copy(database_path('seeders/image/Konsultasi/' . $konsultasi['foto']), $destinationPath);
        }
    }
}