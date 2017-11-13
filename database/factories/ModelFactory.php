<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Model\User::class, function (Faker $faker) {
    static $password;

    return [
        'fullname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'birthday' => $faker->date($format = 'd-m-Y'),
        'address' => $faker->address,
        'image' => $faker->text,
        
    ];
});

$factory->define(App\Model\City::class, function (Faker $faker) {
    return [
        'city' => $faker->city,
    ];
});

$factory->define(App\Model\Cinema::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Model\Room::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'type' => $faker->numberBetween($min=1, $max=4),
        'max_seats' => $faker->numberBetween($min=150, $max=225),
    ];
});


$factory->define(App\Model\Seat::class, function (Faker $faker) {
    return [
        'x_axist' => $faker->numberBetween($min = 1, $max = 15),
        'y_axist' => $faker->randomElement(['A','B','C','D','E','F','G','H','I','J','K']),
        'type' => $faker->numberBetween($min = 1, $max = 3),
    ];
});

$factory->define(App\Model\Schedule::class, function (Faker $faker) {
    return [
        'start_time' => $faker->time,
        'end_time' => $faker->time,
        'date' => $faker->date($format = 'd-m-Y'),
        'available_seats' => $faker->numberBetween($min = 0, $max = 225),
    ];
});

$factory->define(App\Model\Film::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'language' => $faker->word,
        'director' => $faker->name,
        'actor' => $faker->name,
        'year' => $faker->date($format = "Y"),
        'duration' => $faker->time,
        'release' => $faker->date($format = "d-m-Y"),
        'genre' => $faker->text,
        'rated' => $faker->randomElement(['13+','16+','18+']),
        'status' => $faker->numberBetween($min = 0, $max =1),
        'technologies' => $faker->randomElement(['2D', '3D', '4D']),

        
    ];
});

$factory->define(App\Model\BookingFilm::class, function (Faker $faker) {
    return [
        'booking_time' => $faker->dateTimeBetween($min = '2017-10-10'),
        'status' => $faker->numberBetween($min = 0, $max = 1)
    ];
});

$factory->define(App\Model\DetailBooking::class, function (Faker $faker) {
    return [
        'x_axist' => $faker->numberBetween($min = 1, $max = 15),
        'y_axist' => $faker->randomElement(['A','B','C','D','E','F','G','H','I','J','K']),
        'price' => $faker->numberBetween($min = 45000, $max =1000000),
        
    ];
});
