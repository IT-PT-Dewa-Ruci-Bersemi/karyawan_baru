<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 16/11/20
 * Time: 00.18
 */
namespace App\Modules\Admin\Models;

class AdministratorSellerLinkModel extends CoreGenesisModel {
    protected $table    = 'admin_seller_link';

    public function seller() {
        return $this->hasOne(CpngSellerModel::class, 'id', 'seller_id');
    }

    public function admin() {
        return $this->hasOne(AdministratorModel::class, 'id', 'admin_id')->select(['id', 'name', 'phone_number']);
    }
}
