<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $cinemaId = App\Model\Cinema::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\Room::class, 1)->create([
                'cinema_id' => $faker->randomElement($cinemaId)
            ]);
        }
        Model::reguard();
    }
}
