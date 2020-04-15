<?php namespace App\Entities\Document;

use App\Entities\User\User;
use App\Entities\Client\Client;

interface RepositoryInterface {
    public function get(string $id);
    public function getAllForUser(User $user);
    public function getAllForPaymentStatus(string $status);
    public function getAllForClient(Client $client);
}