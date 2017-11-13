<?php
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class BookingFilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Model::unguard();
        $scheduleId = App\Model\Schedule::all('id')->pluck('id')->toArray();
        $userId = App\Model\User::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\BookingFilm::class, 1)->create([
                'user_id' => $faker->randomElement($userId),
                'schedule_id' => $faker->randomElement($scheduleId)
            ]);
        }
        Model::reguard();
    }
}
