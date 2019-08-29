<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    $names = ['Andheri', 'Malad'];
    return [
      'shortcode' => $faker->unique()->randomElement(['MD', 'LW']),
      'name' => $faker->unique()->randomElement($names),
      'email' => $faker->unique()->safeEmail
    ];
});
