<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 20/06/2016
 * Time: 09:58
 */
namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Modules\Admin\Models\MasterNavigationModel;
use App\Modules\Admin\Models\PermissionModel;
use App\Modules\Admin\Models\PositionModel;
use App\Modules\Libraries\Alert;
use App\Modules\Libraries\Breadcrumb;
use Illuminate\Support\Facades\Request;

class AdministratorGroup extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:administrator_group');
        parent::__construct();
        $this->set_page_title('Administrator Position');
        $this->model    = new PositionModel;
    }

    public function index() {
        $positionLevel  = Auth::guard('admin')->user()->position->level;
        if($this->_act == null) {
            if($positionLevel != 101) {
                $this->model = $this->model->where('level', '!=', 101)->where('level', '<', $positionLevel)->orderBy('level', 'DESC');
            }
        } else if($this->_act == 'add') {
            $this->after_save   = '_createDefaultPermission';
        }

        $this->before_delete    = '_beforeDeletePosition';

        $this->data['level']    = $positionLevel-1;
        return $this->init('administrator.group_grid');
    }

    public function _beforeDeletePosition($row) {
        $used   = $row->used()->count();
        if($used) {
            Alert::add('You must unassign admin acocunt with this position before you can delete this data');
            return false;
        }

        $row->permission()->delete();
        return true;
    }

    public function _createDefaultPermission($data) {
        $id = $data->id;
        $permission = new PermissionModel;
        $permission->position_id            = $id;
        $permission->navigation_id          = 1;
        $permission->permission_menu_action     = '';
        $permission->permission_menu_default    = '';
        $permission->save();
    }

    public function permission($id) {
        $position   = PositionModel::find($id);
        if($position) {
            if(Request::has('_token')) {
                return $this->_save_permission($id);
            }
            $this->set_page_title($position->name.'\'s Permissions Access');
            Breadcrumb::add($position->name.'\'s Permission');

            $this->removeDefaultButton('add');
            $this->data['mNavigationList']  = MasterNavigationModel::where('publish', 1)->orderBy('order_id')->get();
            $curr                           = PermissionModel::with('master')->where('position_id', $id)->get();

            $tempMasterNav  = [];
            $tempCurr       = [];
            foreach($curr as $permission) {
                $masterNavID    = $permission->master->master_navigation_id;
                if(!in_array($masterNavID, $tempMasterNav)) array_push($tempMasterNav, $masterNavID);

                $tempCurr[$permission->navigation_id]   = [
                    'menu_action'           => $permission->permission_menu_action != '' ? explode(';', $permission->permission_menu_action) : [],
                    'menu_default'          => $permission->permission_menu_default != '' ? explode(';', $permission->permission_menu_default) : [],
                    'special_permission'    => $permission->special_permission != '' ? explode(';', $permission->special_permission) : []
                ];
            }
            $this->data['groupMasterNav']       = $tempMasterNav;
            $this->data['groupNavPermission']   = $tempCurr;
//            dd($tempCurr);

            return $this->render_view('administrator.permission');
        }
        else return Redirect::route('admin_administrator_group');
    }

    protected function _save_permission($id) {
        $input  = Request::all();
        unset($input['_token']);

        $inputNav   = [];

        foreach($input as $key => $val) {
            if(substr($key, 0, 4) == 'nav-') {
                $inputNav[$key] = $val;
                unset($input[$key]);
            }
        }


        $master = [];
        foreach($inputNav as $key=>$val) {
            $temp   = explode('-', $key);
            if(count($temp) == 2) {
                $master[$temp[1]]  = $val;
                unset($inputNav[$key]);
            }
        }

        $permission = [];
        foreach($input as $key=>$val) {
            $temp       = explode('-', $key);
            $length     = count($temp);
            $lastIndex  = count($temp) - 1;

            if($length == 2) {
                $category   = "menu_action";
                $value      = $temp[0];
            } else if($length == 3) {
                $category   = "menu_default";
                $value      = $temp[1];
            } else if($length == 4) {
                $category   = 'special_permission';
                $value      = $temp[2];
            }

            if(isset($permission[$temp[$lastIndex]][$category])) {
                array_push( $permission[$temp[$lastIndex]][$category], $value );
            } else {
                $permission[$temp[$lastIndex]][$category] = [$value];
            }
        }

        foreach($permission as $key=>&$value){
            if(isset($value['menu_action'])) $value['menu_action']   = implode(';', $value['menu_action']);
            else $value['menu_action']  = '';

            if(isset($value['menu_default'])) $value['menu_default']  = implode(';', $value['menu_default']);
            else $value['menu_default']  = '';

            if(isset($value['special_permission'])) $value['special_permission']    = implode(';', $value['special_permission']);
            else $value['special_permission']   = '';
        }

        PermissionModel::where('position_id', $id)->delete();

        foreach($inputNav as $key=>$on) {
            $temp       = explode('-', $key);
            $lastIndex  = count($temp) - 1;

            $np = new PermissionModel;
            $np->position_id    = $id;
            $np->navigation_id  = $temp[$lastIndex];
            $np->permission_menu_action     = isset($permission[$temp[$lastIndex]]) ? $permission[$temp[$lastIndex]]['menu_action'] : '';
            $np->permission_menu_default    = isset($permission[$temp[$lastIndex]]) ? $permission[$temp[$lastIndex]]['menu_default'] : '';
            $np->special_permission         = isset($permission[$temp[$lastIndex]]) ? $permission[$temp[$lastIndex]]['special_permission'] : '';
            $np->save();
        }
        Alert::add('Successfully Save Permissions', 'success');
        return Redirect::back();
    }
}