<?php

use Faker\Generator as Faker;

$factory->define(App\BlogPost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(10),
        'content' => $faker->paragraphs(5, true)
    ];
});

$factory->state(App\BlogPost::class, 'new-title', function (Faker $faker) {
    return [
        'title' => 'New title',
    ];
});
