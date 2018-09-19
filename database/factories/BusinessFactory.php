<?php

use Faker\Generator as Faker;

$factory->define(App\Business::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'rif' => 'J-'.$faker->unique()->randomNumber(8),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'country' => $faker->country(),
        'state' => $faker->state(),
        'city' =>$faker->city(),
        'address' =>$faker->address(),
        'phone_number' =>$faker->phoneNumber(20),
        'remember_token' => str_random(10),
    ];
});
