<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $filmId = App\Model\Film::all('id')->pluck('id')->toArray();
        $roomId = App\Model\Room::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\Schedule::class, 1)->create([
                'room_id' => $faker->randomElement($roomId),
                'film_id' => $faker->randomElement($filmId)
            ]);
        }

        Model::reguard();
    }
}
