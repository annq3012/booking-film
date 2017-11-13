<?php

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DetailBookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $bookingId = App\Model\BookingFilm::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\DetailBooking::class, 1)->create([
                'booking_film_id' => $faker->randomElement($bookingId)
            ]);
        }
        Model::reguard();
    }
}
