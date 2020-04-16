<?php namespace App\Entities\Payment;

use Faker\Generator as Faker;

class Factory {
    public function __invoke(Faker $faker) {
        return [
            'status' => 'pending',
            'amount' => $faker->randomFloat(2),
            'processed_at' => $faker->dateTimeThisYear()
        ];
    }
}
