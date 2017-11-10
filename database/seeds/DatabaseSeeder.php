<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(FilmsTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CinemasTableSeeder::class);
        $this->call(RoomsTableSeeder::class);
        $this->call(SeatsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(BookingFilmsTableSeeder::class);
        $this->call(DetailBookingsTableSeeder::class);
    }
}
