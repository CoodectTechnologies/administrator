<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = Banner::create([
            'order' => 1,
            'module_web_id' => 10,
            'subtitle' => 'Ingrese aquí su titulo',
            'title' => 'Ingrese aquí su subtitulo',
        ]);
        $banner->image()->create([
            'url' => 'https://d-themes.com/wordpress/wolmart/demo-18/wp-content/uploads/sites/36/2022/05/slide1.jpg',
            'main' => 1,
        ]);

        $banner2 = Banner::create([
            'order' => 2,
            'module_web_id' => 10,
            'subtitle' => 'Ingrese aquí su titulo',
            'title' => 'Ingrese aquí su subtitulo',
        ]);
        $banner2->image()->create([
            'url' => 'https://d-themes.com/wordpress/wolmart/demo-19/wp-content/uploads/sites/39/2022/05/intro-slide1.jpg',
            'main' => 1,
        ]);

        //Secondary
        $banner3 = Banner::create([
            'order' => 3,
            'module_web_id' => 11,
            'subtitle' => 'NEW ARRIVALS',
            'title' => 'Sport Outfits',
        ]);
        $banner3->image()->create([
            'url' => 'https://d-themes.com/wordpress/wolmart/demo-2/wp-content/uploads/sites/5/2021/03/banner-4.jpg',
            'main' => 1,
        ]);
        $banner4 = Banner::create([
            'order' => 4,
            'module_web_id' => 11,
            'subtitle' => 'SMARTWATCHES',
            'title' => 'Sale up to 20% Off',
        ]);
        $banner4->image()->create([
            'url' => 'https://d-themes.com/wordpress/wolmart/demo-2/wp-content/uploads/sites/5/2021/03/banner-4.jpg',
            'main' => 1,
        ]);


        $banners = Banner::with(['image', 'moduleWeb'])->orderBy('order')->get();
        Cache::forget('banners');
        Cache::put('banners', $banners);
    }
}
