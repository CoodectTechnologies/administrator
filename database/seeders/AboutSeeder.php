<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $about = [
            'mission' => 'Remplaza por tu propia información',
            'vision' => 'Remplaza por tu propia información',
            'values' => 'Remplaza por tu propia información',
        ];
        About::create($about);
    }
}
