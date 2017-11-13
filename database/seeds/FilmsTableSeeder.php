<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\Film::class, 15)->create();
        Model::reguard();
    }
}
