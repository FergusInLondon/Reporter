<?php namespace App\Entities\Client;

use App\Entities\Document\Document;
use App\Entities\Client\Client;

class EloquentRepository implements RepositoryInterface {
    public function get(string $id) {
        return Document::findOrFail($id);
    }

    public function getAllForUser(User $user) {
        // stub
    }

    public function getForDocument(Document $doc) {
        // stub
    }
}