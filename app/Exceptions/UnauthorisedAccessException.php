<?php namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UnauthorisedAccessException extends Exception {
    public function render($request) {
        return response()->noContent(Response::HTTP_UNAUTHORIZED);
    }
}
