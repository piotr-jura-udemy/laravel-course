<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'created_at' => $faker->dateTimeBetween('-3 months'),
    ];
});
