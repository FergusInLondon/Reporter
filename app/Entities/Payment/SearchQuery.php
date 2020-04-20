<?php namespace App\Entities\Payment;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

class SearchQuery {

    private $request;

    function __construct(Request $request) {
        $this->request = $request;
    }

    function __invoke(QueryBuilder $query) {
        // client name
        if( $this->request->has('client_name') ){
            $query->where('clients.name', 'LIKE', '%'.$this->request->get('client_name').'%s');
        }

        // payment status
        if( $this->request->has('status') ){
            $query->where('payments.status', '=', $this->request->get('status'));
        }

        // min
        if( $this->request->has('payment_min') ){
            // ! @requires schema changes
        }

        // max
        if( $this->request->has('payment_max') ){
            // ! @todo requires schema changes
        }

        // ! @todo overdue and cancelled.
    }
}