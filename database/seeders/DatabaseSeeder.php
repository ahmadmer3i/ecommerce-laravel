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
        $this->call(EntrustSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductTagSeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(ProductCouponSeeder::class);
        $this->call(ProductReviewSeeder::class);
        $this->call(WorldSeeder::class);
        $this->call(WorldStatusSeeder::class);
    }
}
