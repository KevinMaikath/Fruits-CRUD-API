<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Fruit;
use Faker\Generator as Faker;

$factory->define(Fruit::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'size' => array_values(Fruit::SIZES)[$faker->numberBetween(0, 2)],
        'colour' => $faker->colorName
    ];
});
