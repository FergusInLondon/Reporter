<?php namespace App\Entities\Client;

class Client extends \App\Entities\ValidationModel
{
    protected $rules = array(
        'name' => 'required'
    );

    protected $fillable = array(
        'name', 'contact_email', 'contact_tel', 'contact_preferences'
    );

    public function user()
    {
        return $this->belongsTo('App\Entities\User\User');
    }
}