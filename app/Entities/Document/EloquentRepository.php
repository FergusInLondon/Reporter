<?php namespace App\Entities\Document;

use App\Entities\User\User;
use App\Entities\Client\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EloquentRepository implements RepositoryInterface {

    private $currentUser;

    public function __construct() {
        $this->currentUser = Auth::user();
    }

    public function baseQuery() {
        return DB::table('documents')
            ->leftJoin('clients', 'documents.client_id', '=', 'clients.id')
            ->leftJoin('payments', 'payments.document_id', '=', 'documents.id')
            ->select(
                'documents.*', 'payments.status', 'clients.name as client_name'
            )->where('documents.user_id', '=', $this->currentUser->id);
    }

    public function get(string $id) {
        return $this->baseQuery()->where('documents.id', '=', $id)->first();
    }

    public function getAllForCurrentUser(Callable $filters) {
        $query = $this->baseQuery();
        $filters($query);

        return $query->get();
    }

    public function getAllForPaymentStatus(string $status) {
        return $this->baseQuery->where('payments.status', '=', $status)->get();
    }

    public function getAllForClient(Client $clientId) {
        return $this->basequery()->where('users.id', '=', $id)->get();
    }
}