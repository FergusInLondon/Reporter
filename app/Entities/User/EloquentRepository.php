<?php namespace App\Entities\User;

class EloquentRepository implements RepositoryInterface {
    public function get(string $id) {
        return User::findOrFail($id);
    }
}