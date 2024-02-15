<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'nama_lengkap'=>'Admin '.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'role'=>'admin',
                'email'=>"Admin".$i."@gmail.com",
                'password'=>Hash::make('Admin@1234567890'),
                'foto'=>Str::random(5),
                'verifikasi'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
        }
    }
}