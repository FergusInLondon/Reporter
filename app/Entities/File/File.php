
<?php namespace App\Entities\File;

class File extends \App\Entities\ValidationModel
{
    public function document()
    {
        return $this->belongsTo('App\Entities\Document\Document');
    }
}
