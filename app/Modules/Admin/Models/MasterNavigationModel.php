<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/09/2015
 * Time: 5:03 PM
 */
namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class MasterNavigationModel extends Model {
    protected $table    = 'master_navigation';

    public function navigation() {
        return $this->hasMany('App\Modules\Admin\Models\NavigationModel', 'master_navigation_id', 'id')->where('publish',1)
            ->where('parent_id',0)->orderBy('order_id');
    }
}