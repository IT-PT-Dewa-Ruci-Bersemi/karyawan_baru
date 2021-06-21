<?php
/**
 * Created by PhpStorm.
 * User: Outpost-PC2
 * Date: 9/22/2015
 * Time: 11:54 AM
 */
namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class NavigationModel extends Model {
    protected $table    = 'navigation';
    protected $with     = ['subnav'];

    public function subNav() {
        return $this->hasMany('App\Modules\Admin\Models\NavigationModel', 'parent_id', 'id')->where('publish', 1)->orderBy('order_id');
    }
}