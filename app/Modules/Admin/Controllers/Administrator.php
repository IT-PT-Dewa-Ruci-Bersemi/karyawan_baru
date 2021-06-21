<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 18:06
 */
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\AdministratorModel;
use App\Modules\Admin\Models\PositionModel;
use Illuminate\Support\Facades\Auth;

class Administrator extends GenesisController {
    function __construct(){
        $this->middleware('admin_role:administrator');
        parent::__construct();
        $this->model                = new AdministratorModel;
        $this->data['page_title']   = "Administrator";
        $this->model->setRules([
            'email' => 'email|unique:administrator'
        ]);
        $this->model->setEditRules([
            'email' => 'email|unique:administrator,email,#id'
        ]);
    }

    public function index() {
        $user   = Auth::guard('admin')->user();

        if($this->_act == null)
            $this->model    = $this->model->whereNotIn('position_id', [1, $user->position_id]);

        $this->before_save          = '_setPassword';
        $level                      = $user->position->level;
        $this->data['positions']    = $this->_get_filter_select(PositionModel::where('level', '<', $level)->orderBy('level','desc'), 'name');

        return $this->init('administrator.administrator_grid');
    }

    public function _setPassword($data) {
        $data->password = 'admin';
        return true;
    }
}
