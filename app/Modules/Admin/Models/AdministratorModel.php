<?php namespace App\Modules\Admin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class AdministratorModel extends CoreGenesisModel implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;
    protected $table    = 'administrator';
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden   = ['password', 'remember_token'];
    protected $with     = ['position'];
    //
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);

    }

    public function position() {
        return $this->belongsTo('App\Modules\Admin\Models\PositionModel', 'position_id', 'id');
    }

    public function sellerLink() {
        return $this->hasOne(AdministratorSellerLinkModel::class, 'admin_id');
    }
}
