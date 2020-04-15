<?php namespace App\Entities\Document;

use App\Entities\User\User;
use App\Entities\Client\Client;

interface RepositoryInterface {
    public get(string $id);
    public getAllForUser(User $user);
    public getAllForPaymentStatus(string $status);
    public getAllForClient(Client $client);
}