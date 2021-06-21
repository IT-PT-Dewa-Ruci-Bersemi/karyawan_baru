<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/09/2015
 * Time: 9:12 PM
 */
namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model {
    protected $table    = 'admin_position';

    public function permission() {
        return $this->hasMany('App\Modules\Admin\Models\PermissionModel', 'position_id', 'id');
    }

    public function used() {
        return $this->hasMany('App\Modules\Admin\Models\AdministratorModel', 'position_id', 'id');
    }
}