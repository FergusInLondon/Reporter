<?php namespace App\Entities\Document;

use Faker\Generator as Faker;

class Factory {
    public function __invoke(Faker $faker) {
        return [
            'name' => $faker->sentence(),
            'description' => $faker->paragraph()
        ];
    }
}