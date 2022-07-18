<?php

namespace Database\Seeders;

use App\Models\NoticiaTipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticiaTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NoticiaTipo::factory()->count(5)->create();
    }
}
