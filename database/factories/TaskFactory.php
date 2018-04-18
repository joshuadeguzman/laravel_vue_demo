<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'description' => $faker->sentence($nbWords = 20, $variableNbWords = true),
        'user_id' => function() {
            return factory(App\User::class)->create()->id;
        },
    ];
});
