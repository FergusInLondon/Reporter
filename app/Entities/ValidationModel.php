<?php namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 
 * Based off of Dayle Rees' great post, available here:
 *  https://daylerees.com/trick-validation-within-models/
 */
class ValidationModel extends Model
{
    use SoftDeletes;

    use Uuid;
    protected $keyType = 'string';
    public $incrementing = false;

    private $errors;
    protected $rules = array();

    public function validateAndFill($data) {
        if (!empty($this->rules)) {
            $v = Validator::make($data, $this->rules);
            if ($v->fails()) {
                $this->errors = $v->errors();
                return false;
            }    
        }

        $this->fill($data);
        return true;
    }

    public function errors() {
        return $this->errors;
    }
}
