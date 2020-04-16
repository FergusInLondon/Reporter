<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create 10 users with 5 clients each
        factory(App\Entities\User\User::class, 10)
            ->create()
            ->each(function($user) {
                $user->clients()->createMany(
                    factory(App\Entities\Client\Client::class, 5)
                        ->make()->toArray()
                );
            });
        
        // Give all clients 10 documents
        App\Entities\Client\Client::all()->each(function($client){
            factory(App\Entities\Document\Document::class, 10)
                ->make()
                ->each(function($document) use ($client) {
                    $document->user_id = $client->user->id;
                    $document->client_id = $client->id;
                    $document->save();

                    factory(App\Entities\File\File::class, 1)
                        ->make()
                        ->each(function($file) use ($document) {
                            $file->document_id = $document->id;
                            $file->save();
                        });
                    
                    factory(App\Entities\Payment\Payment::class, 1)
                        ->make()
                        ->each(function($payment) use ($document) {
                            $payment->document_id = $document->id;
                            $payment->save();
                        });
                });
        });
    }
}
