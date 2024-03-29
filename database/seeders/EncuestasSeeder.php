<?php

namespace Database\Seeders;

use App\Models\encuestas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncuestasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        encuestas::factory(5)->create();
    }
}
