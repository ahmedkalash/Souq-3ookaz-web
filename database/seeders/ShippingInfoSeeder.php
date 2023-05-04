<?php

namespace Database\Seeders;

use App\Models\ShippingInfo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ShippingInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate 50 shipping info records
        for ($i = 0; $i < 50; $i++) {
            ShippingInfo::create([
                'customer_full_name' => $faker->name,
                'address_1' => $faker->streetAddress,
                'address_2' => $faker->secondaryAddress,
                'city' => $faker->city,
                'state' => $faker->stateAbbr,
                'zip_code' => $faker->postcode,
                'country' => $faker->country,
                'phone_number' => $faker->phoneNumber,
            ]);
        }
    }
}
