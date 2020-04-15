<?php namespace App\Entities\User;

interface RepositoryInterface {
    public function get(string $id);
}