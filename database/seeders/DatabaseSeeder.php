<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\ShippingAddress;
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
        //System
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ModuleWebSeeder::class);

        //Web
        $this->call(AboutSeeder::class);
        // $this->call(VideoSeeder::class);
        // $this->call(BlogTagSeeder::class);
        // $this->call(BlogCategorySeeder::class);
        // $this->call(BlogPostSeeder::class);
        // $this->call(SubscriberSeeder::class);

        //Ecommerce
        $this->call(BannerSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductGenderSeeder::class);
        // $this->call(ProductSeeder::class);
        $this->call(ShippingZoneSeeder::class);
        // $this->call(OrderSeeder::class);
        // $this->call(ShippingAddressSeeder::class);
    }
}
