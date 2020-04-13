<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)
            ->create()
            ->each(function($user) {
                $user->documents()->createMany(
                    factory(App\Document::class, 5)
                        ->make()->toArray()
                );
            });
    }
}
