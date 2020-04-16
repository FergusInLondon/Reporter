<?php namespace App\Entities\Payment;

class Payment extends \App\Entities\ValidationModel
{
    protected $rules = array(
        'amount' => 'required'
    );

    protected $fillable = array(
        'amount'
    );

    public function document()
    {
        return $this->belongsTo('App\Entities\Document\Document');
    }
}