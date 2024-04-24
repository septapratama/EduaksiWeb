<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use Illuminate\Support\Str;
use App\Models\Event;
use Carbon\Carbon;
class EventSeeder extends Seeder
{
    public function run(): void
    {
        $date = Carbon::now()->addDays(mt_rand(1,9));
        for($i = 1; $i <= 3; $i++){
            Event::insert([
                'uuid' =>  Str::uuid(),
                'nama_event' => Str::random(25),
                'deskripsi' => Str::random(40),
                'tempat' => Str::random(25),
                'tanggal_awal' => $date,
                'tanggal_akhir' => $date->copy()->addDays(mt_rand(1,9)),
            ]);
        }
    }
}