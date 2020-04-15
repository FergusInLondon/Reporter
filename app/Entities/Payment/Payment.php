
<?php namespace App\Entities\Payment;

class Payment extends \App\Entities\ValidationModel
{
    public function document()
    {
        return $this->belongsTo('App\Entities\Document\Document');
    }
}