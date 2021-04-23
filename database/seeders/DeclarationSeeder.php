<?php

namespace Database\Seeders;

use App\Models\Declaration;
use Illuminate\Database\Seeder;

class DeclarationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Declaration::factory() 
            ->count(50)
            ->create();
    }
}
