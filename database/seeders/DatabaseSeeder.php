<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
        \App\Models\Staff::factory(5)->create();
        \App\Models\Office::factory(3)->create();
        \App\Models\Declaration::factory(50)->create();
    }
}
