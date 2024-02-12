<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Konsultasi;
use Carbon\Carbon;
class KonsultasiSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i <= 5; $i++){
            Konsultasi::insert([
                'nama_lengkap'=>'Konsultasi'.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0852'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'email'=>"KonsultaTesting".$i."@gmail.com",
                'foto'=>Str::random(5),
            ]);
        }
    }
}