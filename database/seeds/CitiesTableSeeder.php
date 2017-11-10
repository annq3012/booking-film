<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\City::class, 15)->create();
        Model::reguard();
    }
}
