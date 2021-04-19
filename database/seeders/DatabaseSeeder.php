<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Database\Seeders\UsuarioSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsuarioSeeder::class);
    }
}
