<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Document::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'document_uri' => $faker->url,
    ];
});
