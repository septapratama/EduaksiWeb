<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\Crypt;
Use Illuminate\Support\Facades\Hash;
Use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            'uuid' =>  Str::uuid(),
            'nama_lengkap'=>'Admin utama',
            'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
            'no_telpon'=>'0851'.mt_rand(10000000,99999999),
            'alamat'=>'Jalan surabaya',
            'role'=>'admin',
            'email'=>"Admin@gmail.com",
            'password'=>Hash::make('Admin@1234567890'),
            'foto'=>'3.jpeg',
            'verifikasi'=>true,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        Storage::disk('admin')->put('/foto/3.jpeg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/3.jpeg'))));
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Admin '.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'alamat'=>'Jalan surabaya',
                'role'=>'admin',
                'email'=>"Admin".$i."@gmail.com",
                'password'=>Hash::make('Admin@1234567890'),
                'foto'=>'2.jpg',
                'verifikasi'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            Storage::disk('admin')->put('/foto/2.jpg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/2.jpg'))));
        }
        $directory = storage_path('app/database');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}