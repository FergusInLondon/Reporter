<?php namespace App;

class Document extends ValidationModel
{
    protected $rules = array(
        'name' => 'required',
        'document_uri' => 'required',
    );

    protected $fillable = array('name', 'description', 'document_uri');

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}