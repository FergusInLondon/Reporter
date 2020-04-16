<?php namespace App\Entities\File;

use Faker\Generator as Faker;

class Factory {
    public function __invoke(Faker $faker) {
        return [
            'revision' => 0,
            'uri' => $faker->url,
            'filename' => $faker->name
        ];
    }
}