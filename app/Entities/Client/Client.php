
<?php namespace App\Entities\Client;

class Client extends \App\Entities\ValidationModel
{
    public function user()
    {
        return $this->belongsTo('App\Entities\User\User');
    }
}