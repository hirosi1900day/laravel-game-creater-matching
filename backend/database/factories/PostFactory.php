<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $this->faker->realText(10),
        'content' => $this->faker->realText(20),
        'point' => $this->faker->realText(30),
        'resources_required' => $this->faker->realText(20),
        'area' => $this->faker->realText(20),
        'qualification' => $this->faker->realText(20),
        'created_at' => $faker->datetime($max = 'now', $timezone =   date_default_timezone_get()),
        'updated_at' => $faker->datetime($max = 'now', $timezone =  date_default_timezone_get())
    ];
});

