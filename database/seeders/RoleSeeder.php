<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $administrador = Role::create(['name' => 'Administrador']);
        $copywriter = Role::create(['name' => 'Copywriter']);
        $productManager = Role::create(['name' => 'Product manager']);
        $webManager = Role::create(['name' => 'Web manager']);

        //Assing permissions
        $administrador->givePermissionTo(
            Permission::all()->pluck('name')->toArray()
        );
        $copywriter->givePermissionTo([
            'blog',
            'blog categorías',
            'blog etiquetas'
        ]);
        $productManager->givePermissionTo([
            'ordenes',
            'productos',
            'producto categorías',
            'producto marcas',
            'producto géneros',
            'comentarios',
            'países',
            'estados',
            'zonas de envío',
            'clases de envío'
        ]);
        $webManager->givePermissionTo([
            'banners',
            'galería',
            'team',
            'videos',
            'servicios',
            'portafolio',
            'socios',
            'blog',
            'blog categorías',
            'blog etiquetas',
            'correos',
            'subscriptores',
            'módulos web'
        ]);
    }
}
