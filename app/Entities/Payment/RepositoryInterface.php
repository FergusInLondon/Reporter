
<?php namespace App\Entities\Payment;

use App\Entities\Document\Document;
use App\Entities\Client\Client;

interface RepositoryInterface {
    public function get(string $id);
    public function getForDocument(Document $doc);
    public function getAllForClient(Client $client);
}
