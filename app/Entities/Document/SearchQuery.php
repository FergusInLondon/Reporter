<?php namespace App\Entities\Document;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

class SearchQuery {

    private $request;

    function __construct(Request $request) {
        $this->request = $request;
    }

    function __invoke(QueryBuilder $query) {
        if( $this->request->has('status') ){
            $query->where('payments.status', '=', $this->request->get('status'));
        }

        if( $this->request->has('client') ){
            $query->where('clients.name', 'LIKE', '%'.$this->request->get('client').'%');
        }

        if( $this->request->has('name') ){
            $query->where('documents.name', 'LIKE', '%'.$this->request->get('name').'%');
        }
    }
}