<?php namespace App\Entities\Payment;

use Illuminate\Support\Facades\Auth;
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

    public function getAllForUser(User $user) {
        $userId = $this->currentUser->id;

        return Payment::whereHas('document', function(Builder $query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
    }

    public function get(string $id) {
        $payment = Payment::findOrFail($id);
        if ($payment->user_id != $this->currentUser->id) {
            throw new UnauthorisedAccessException();
        }

        return $payment;
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