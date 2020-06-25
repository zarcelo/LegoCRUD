<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Lego;
use Faker\Generator as Faker;

$factory->define(Lego::class, function (Faker $faker) {
    $images = ['/images/full/1.png', '/images/full/2.png', '/images/full/3.png', '/images/full/4.png', '/images/full/5.png', '/images/full/6.png', '/images/full/7.png'];

    return [
        'name' => $faker->name,
        'description' => $faker->sentence,
        'type' => $faker->randomElement($array = array('Hero', 'Villain')),
        'url' => $faker->randomElement($images)
    ];
});
