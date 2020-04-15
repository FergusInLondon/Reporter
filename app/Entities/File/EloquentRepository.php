<?php namespace App\Entities\File;

use App\Entities\Document\Document;

class EloquentRepository implements RepositoryInterface {
    public function get(string $id) {
        return File::findOrFail($id);
    }

    public function getByDocument(Document $doc) {
        return $doc->file();
    }
}
