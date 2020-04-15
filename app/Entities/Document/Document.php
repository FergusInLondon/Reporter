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
}