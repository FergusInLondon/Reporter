<?php namespace App\Entities\Document;

use App\Entities\User\User;
use App\Entities\Client\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exceptions\UnauthorisedAccessException;

class EloquentRepository implements RepositoryInterface {

    private $currentUser;

    public function __construct() {
        $this->currentUser = Auth::user();
    }

    public function get(string $id) {
        return $this->currenUser->documents()->findOrFail($id);
    }

    public function getAllForUser(User $user) {
        if ($user->id != $this->currentUser->id) {
            throw new UnauthorisedAccessException();
        }

        return $user->documents();
    }

    public function getAllForPaymentStatus(string $status) {
        return Document::where('user_id', $this->currentUser->id)
            ->whereHas('payment', function(Builder $query) use ($status) {
                $query->where('status', $status);
            })->get();
    }

    public function getAllForClient(Client $client) {
        return Document::where('user_id', $this->currentUser->id)
            ->whereHas('client', function(Builder $query) use ($client) {
                $query->where('client_id', $client->id)
            })->get();
    }
}