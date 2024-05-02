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
        //super admin
        User::insert([
            'uuid' =>  Str::uuid(),
            'nama_lengkap'=>'Admin utama',
            'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
            'no_telpon'=>'0851'.mt_rand(10000000,99999999),
            'role'=>'super admin',
            'email'=>"SuperAdmin@gmail.com",
            'password'=>Hash::make('Admin@1234567890'),
            'foto'=>'3.jpeg',
            'verifikasi'=>true,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        Storage::disk('admin')->put('/foto/3.jpeg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/3.jpeg'))));
        User::insert([
            'uuid' =>  Str::uuid(),
            'nama_lengkap'=>'Admin testing',
            'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
            'no_telpon'=>'0851'.mt_rand(10000000,99999999),
            'role'=>'super admin',
            'email'=>"AdminTesting@gmail.com",
            'password'=>Hash::make('Admin@1234567890'),
            'foto'=>'3.jpeg',
            'verifikasi'=>true,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);

        //admin disi
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Admin disi '.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'role'=>'admin disi',
                'email'=>"AdminDisi".$i."@gmail.com",
                'password'=>Hash::make('Admin@1234567890'),
                'foto'=>'2.jpg',
                'verifikasi'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            Storage::disk('admin')->put('/foto/2.jpg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/2.jpg'))));
        }

        //admin emotal
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Admin emotal '.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'role'=>'admin emotal',
                'email'=>"AdminEmotal".$i."@gmail.com",
                'password'=>Hash::make('Admin@1234567890'),
                'foto'=>'2.jpg',
                'verifikasi'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            Storage::disk('admin')->put('/foto/2.jpg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/2.jpg'))));
        }

        //admin nutrisi
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Admin nutrisi'.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'role'=>'admin nutrisi',
                'email'=>"AdminNutrisi".$i."@gmail.com",
                'password'=>Hash::make('Admin@1234567890'),
                'foto'=>'2.jpg',
                'verifikasi'=>true,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            Storage::disk('admin')->put('/foto/2.jpg', Crypt::encrypt(file_get_contents(database_path('seeders/image/Admin/2.jpg'))));
        }

        //admin pengasuhan
        for($i = 1; $i <= 3; $i++){
            User::insert([
                'uuid' =>  Str::uuid(),
                'nama_lengkap'=>'Admin pengasuhan '.$i,
                'jenis_kelamin'=>['laki-laki', 'perempuan'][rand(0, 1)],
                'no_telpon'=>'0851'.mt_rand(10000000,99999999),
                'role'=>'admin pengasuhan',
                'email'=>"AdminPengasuhan".$i."@gmail.com",
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