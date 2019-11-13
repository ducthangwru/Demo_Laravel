<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
        'content' => $faker->text
    ];
});
