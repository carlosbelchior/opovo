<?php

namespace Database\Seeders;

use App\Models\Jornalista;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JornalistaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jornalista::factory()->count(10)->create();
    }
}
