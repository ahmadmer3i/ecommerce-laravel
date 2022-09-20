<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UserAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        DB::table('user_addresses')->truncate();

        $faker = Factory::create();

        $ahmad = User::whereUsername('ahmad')->first();
        $jordan = Country::with('states')->whereId(111)->first();
        $state = $jordan->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;

        $ahmad->addresses()->create([
            'address_title' => 'Home',
            'default_address' => true,
            'first_name' => 'Ahmad',
            'last_name' => 'Merie',
            'email' => $faker->email,
            'mobile' => $faker->phoneNumber,
            'address' => $faker->address,
            'address2' => $faker->secondaryAddress,
            'country_id' => $jordan->id,
            'state_id' => $state,
            'city_id' => $city,
            'zip_code' => $faker->randomNumber(5),
            'po_box' => $faker->randomNumber(4),
        ]);

        $state = $jordan->states->random()->id;
        $city = City::whereStateId($state)->inRandomOrder()->first()->id;
        $ahmad->addresses()->create([
            'address_title' => 'Work',
            'default_address' => false,
            'first_name' => 'Ahmad',
            'last_name' => 'Merie',
            'email' => $faker->email,
            'mobile' => $faker->phoneNumber,
            'address' => $faker->address,
            'address2' => $faker->secondaryAddress,
            'country_id' => $jordan->id,
            'state_id' => $state,
            'city_id' => $city,
            'zip_code' => $faker->randomNumber(5),
            'po_box' => $faker->randomNumber(4),
        ]);

        User::where('id', '>', 3)->each(function ($user) use ($faker, $jordan, $state, $city) {
            $state = $jordan->states->random()->id;
            $city = City::whereStateId($state)->inRandomOrder()->first()->id;
            $user->addresses()->create([
                'address_title' => 'Home',
                'default_address' => true,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $user->email,
                'mobile' => $user->mobile,
                'address' => $faker->address,
                'address2' => $faker->streetAddress,
                'country_id' => $jordan->id,
                'state_id' => $state,
                'city_id' => $city,
                'zip_code' => $faker->randomNumber(5),
                'po_box' => $faker->randomNumber(4),
            ]);
        });
        Schema::enableForeignKeyConstraints();
    }

}
