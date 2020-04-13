<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
/**
 * 
 * Based off of Dayle Rees' great post, available here:
 *  https://daylerees.com/trick-validation-within-models/
 */
class ValidationModel extends Model
{
    private $errors;

    protected $rules;

    public function validateAndFill($data) {
        $v = Validator::make($data, $this->rules);
        if ($v->fails()) {
            $this->errors = $v->errors;
            return false;
        }

        $this->fill($data);
        return true;
    }

    public function errors() {
        return $this->errors;
    }
}
