<?php

namespace Database\Seeders;

use App\Models\ModuleWeb;
use Illuminate\Database\Seeder;

class ModuleWebSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleWebs = [
            ['name' => 'Inicio'],
            ['name' => 'Nosotros'],
            ['name' => 'Servicios'],
            ['name' => 'Portafolio'],
            ['name' => 'Team'],
            ['name' => 'Blog'],
            ['name' => 'Productos'],
            ['name' => 'Videos'],
            ['name' => 'Contacto']
        ];
        ModuleWeb::insert($moduleWebs);
    }
}
