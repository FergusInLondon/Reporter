<?php namespace App\Entities\Client;

use App\Entities\User\User;
use App\Entities\Document\Document;

interface RepositoryInterface {
    public get(string $id);
    public getAllForUser(User $user);
    public getForDocument(Document $doc);
}