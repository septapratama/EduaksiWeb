<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Pencatatan;
use Carbon\Carbon;
class PencatatanSeeder extends Seeder
{
    public function run(): void
    {
        $max = 10;
        $userData = User::select('id_user')->where('role','user')->where('is_shop_owner',false)->limit($max)->get();
        if($userData->isEmpty()){
            $this->call(UserSeeder::class);
            $userData = User::select('id_user')->where('role','user')->where('is_shop_owner',false)->limit($max)->get();
        }
        for($i = 0; $i < $max; $i++){
            $rand = rand(0, $max - 2);
            Pencatatan::insert([
                'nama_anak'=> Str::random(15),
                'umur' => rand(0,12),
                'gol_darah'=>['A','B','AB','O'][rand(0, 3)],
                'hasil_gizi' => rand(10,40),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'id_user' => $userData[$rand]->id_user,
            ]);
        }
    }
}