<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    $password = 'admin@123';
    $usernames = ['faisal', 'bilal', 'vijay'];
    $emails = ['faisal@neev.io', 'bilal@neev.io', 'vijay@neev.io'];
    $phone_numbers = ['8433776085', '985120000', '785522000'];
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->unique()->randomElement($emails),
        'email_verified_at' => now(),
        'phone' => $faker->unique()->randomElement($phone_numbers),
        'password' => $password, // password
        'api_token' => Str::random(60),
        'remember_token' => Str::random(10),
    ];
});
