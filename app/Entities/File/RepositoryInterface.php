<?php namespace App\Entities\File;

use App\Entities\Document\Document;

interface RepositoryInterface {
    public get(string $id);
    public getByDocument(Document $doc);
}