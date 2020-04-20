<?php namespace App\Entities\Payment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Entities\Document\Document;
use App\Entities\Client\Client;
use App\Entities\User\User;
use App\Exceptions\UnauthorisedAccessException;

class EloquentRepository implements RepositoryInterface {

    private $currentUser;

    public function __construct() {
        $this->currentUser = Auth::user();
    }

    private function baseQuery() {
        return DB::table('payments')
            ->leftJoin('documents', 'payments.document_id', '=', 'documents.id')
            ->leftJoin('clients', 'documents.client_id', '=', 'clients.id')
            ->select(
                'payments.id', 'payments.status', 'payments.created_at', 'payments.updated_at',
                'payments.amount', 'payments.document_id', 'documents.client_id',
                'documents.name AS document_name', 'clients.name as client_name'
            )->where('documents.user_id', '=', $this->currentUser->id);
    }

    public function getForCurrentUser(SearchQuery $filters) {
        $searchQuery = $this->baseQuery();
        $filters($searchQuery);
        return $searchQuery->get();
    }

    public function get(string $id) {
        return $this->baseQuery()->where('payments.id', '=', $id)->first();
    }

    public function getForDocument(Document $doc) {
        if ($document->user_id != $this->currentUser->id) {
            throw new UnauthorisedAccessException();
        }

        return $doc->payments();
    }

    public function getAllForClient(Client $client) {

    }
}