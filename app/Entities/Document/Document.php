<?php namespace App\Entities\Document;

class Document extends \App\Entities\ValidationModel
{
    protected $rules = array(
        'name' => 'required',
        'document_uri' => 'required',
    );

    protected $fillable = array('name', 'description', 'document_uri');

    public function user()
    {
        return $this->belongsTo('App\Entities\User\User');
    }

    public function client()
    {
        return $this->belongsTo('App\Entities\Client\Client');
    }

    public function file()
    {
        return $this->hasOne('App\Entities\File\File');
    }

    public function payment()
    {
        return $this->hasOne('App\Entities\Payment\Payment');
    }
}