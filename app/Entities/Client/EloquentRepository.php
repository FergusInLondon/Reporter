<?php namespace App\Entities\Client;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

use App\Entities\Document\Document;
use App\Entities\Client\Client;
use App\Entities\User\User;

class EloquentRepository implements RepositoryInterface {

    private $currentUser;

    public function __construct() {
        $this->currentUser = Auth::user();
    }

    private function baseQuery() {
        return DB::table('clients')
            ->leftJoin('documents', 'documents.client_id', '=', 'clients.id')
            ->leftJoin('payments', 'payments.document_id', '=', 'documents.id')
            ->select(DB::raw(
                'clients.id, clients.contact_email, clients.contact_tel, clients.contact_preferences, clients.name, count(documents.id) as documents_count, count(payments.id) filter (where payments.status != \'successful\') as outstanding_count'
            ))->groupBy('clients.id')
            ->where('clients.user_id', '=', $this->currentUser->id)
            ->whereNull('clients.deleted_at');
    }

    public function getAutocompleteSuggestions() {
        return DB::table('clients')
            ->select('id', 'name')
            ->where('user_id', '=', $this->currentUser->id)
            ->get();
    }

    public function get(string $clientId) {
        return $this->baseQuery()->where(
            'clients.id', '=', $clientId
        )->first();
    }


    public function getAllForCurrentUser() {
        return $this->baseQuery()->get();
    }

    public function getForDocument(string $documentId) {
        return $this->baseQuery()->where('documents.id', '=', $documentId)->first();
        // stub
    }
}