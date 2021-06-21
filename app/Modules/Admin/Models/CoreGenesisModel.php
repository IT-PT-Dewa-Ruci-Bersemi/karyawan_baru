<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 16/06/2016
 * Time: 11:00
 */
namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class CoreGenesisModel extends Model {
    protected $createRules      = [];
    protected $editRules        = [];
    protected $validationMsg    = [];
    protected $namespace        = "App\Modules\Admin\Models";

    protected $errorTransaction;

    public function validate($data, $edit = false, $id = false)
    {
        if(count($this->createRules) || count($this->editRules)) {
            if ($edit) {
                if (count($this->editRules)){
                    foreach($this->editRules as $field=>&$rule) {
                        $rule   = str_replace('#id', $id, $rule);
                    }
                    $v = Validator::make($data, $this->editRules);
                } else if (count($this->createRules)) $v = Validator::make($data, $this->createRules, $this->validationMsg);
            } else {
                if(count($this->createRules)) $v = Validator::make($data, $this->createRules, $this->validationMsg);
            }

            if(isset($v)) {
                if ($v->fails()) {
                    $this->errorTransaction = $v->errors();
                    return false;
                }
            }
        }
        return true;
    }


    public function getValidationError() {
        return $this->errorTransaction;
    }

    public function setRules($array) {
        $this->createRules    = $array;
        return true;
    }

    public function setValidationMessage($array) {
        $this->validationMsg    = $array;
        return true;
    }

    public function setEditRules($array) {
        $this->editRules    = $array;
        return true;
    }
}