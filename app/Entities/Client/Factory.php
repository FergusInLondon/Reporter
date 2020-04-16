<?php namespace App\Entities\Client;

use Faker\Generator as Faker;

class Factory {
    public function __invoke(Faker $faker) {
        return [
            'name' => $faker->name,
            'contact_email' => $faker->safeEmail,
            'contact_tel' => $faker->e164PhoneNumber,
            'contact_preferences' => 2
        ];
    }
}