<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $users = App\User::pluck('id')->toArray();
    return [
        'title' => $faker->word,
        'description' => $faker->paragraph,
        'priority' => $faker->randomElement(['low','medium','high']),
        'user_id' =>  $faker->randomElement($users),
        'completed' => $faker->boolean($chanceOfGettingTrue = 50) 
    ];
});
