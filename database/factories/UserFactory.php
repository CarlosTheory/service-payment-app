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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'dni' => 'V-'.$faker->unique()->randomNumber(8),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'country' => $faker->country(),
        'state' => $faker->state(),
        'city' =>$faker->city(),
        'address' =>$faker->address(),
        'phone_number' =>$faker->phoneNumber(20),
        'remember_token' => str_random(10),
    ];
});
