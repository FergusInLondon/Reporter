<?php namespace App\Entities\Payment;

use App\Entities\Document\Document;
use App\Entities\Client\Client;
use App\Entities\User\User;

interface RepositoryInterface {
    public function get(string $id);
    public function getAllForUser(User $user);
    public function getForDocument(Document $doc);
    public function getAllForClient(Client $client);
}
