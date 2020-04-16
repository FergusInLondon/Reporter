<?php namespace App\Entities\Client;

use App\Entities\User\User;
use App\Entities\Document\Document;

interface RepositoryInterface {
    public function get(string $id);
    public function getAllForUser(User $user);
    public function getForDocument(Document $doc);
}