<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 24/09/2015
 * Time: 9:49 AM
 */
namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class PermissionModel extends Model {
    protected $table    = 'admin_permission';

    public function master() {
        return $this->hasOne('App\Modules\Admin\Models\NavigationModel', 'id', 'navigation_id');
    }
}