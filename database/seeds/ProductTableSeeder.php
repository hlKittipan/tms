<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('products')->insert([
                'code' => Carbon::now()->format('ymdhms'),
                'name' => $faker->company,
                'number_of_pax' => rand(10, 100),
                'duration_days' => rand(1, 10),
                'duration_nights' => rand(1, 10),
                'includes' => $faker->catchPhrase,
                'excludes' => $faker->catchPhrase,
                'conditions' => $faker->catchPhrase,
                'itinerary' => $faker->catchPhrase,
                'remark' => $faker->catchPhrase,
                'product_type_id' => rand(1, 3),
                'status' => '1',
                'staff_id' => '1'
            ]);
        }
    }
}
