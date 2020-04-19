<?php namespace App\Entities\Client;

use App\Entities\User\User;
use App\Entities\Document\Document;

interface RepositoryInterface {
    public function get(string $clientId);
    public function getAllForCurrentUser();
    public function getForDocument(string $documentId);
}