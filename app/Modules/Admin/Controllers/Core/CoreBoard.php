<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/09/2017
 * Time: 21:13
 */
namespace App\Modules\Admin\Controllers\Core;

use App\Modules\Admin\Controllers\AdminController;
use App\Modules\Admin\Controllers\GenesisController;
use App\Modules\Admin\Models\AppsConfigModel;
use App\Modules\Admin\Models\MasterNavigationModel;
use App\Modules\Admin\Models\NavigationModel;
use App\Modules\Admin\Models\PermissionModel;
use App\Modules\Admin\Models\SoalModel;
use App\Modules\Libraries\Alert;
use App\Modules\Libraries\Breadcrumb;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

class CoreBoard extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:false,1');
        parent::__construct();
        set_time_limit(1000000);
    }


    public function index() {
        if(Auth::guard('admin')->user()->position_id != 1) {
            return route('admin_dashboard');
        }

        $this->independentPage('Master Test', '<b>Super Administrator</b> Testing Module');
        Breadcrumb::add('Master Test');

        $this->data['modules']  = [
			[
				'name'=>'Master Navigation',
				'route'=>'_core_apps_master_navigation'
			],
			[
				'name'=>'Docs',
				'route'=>'_core_apps_docs'
			]
        ];


        return $this->render_view('core.core_board');
    }

	public function masterNavigation() {
		if(Auth::guard('admin')->user()->position_id != 1) {
			return route('admin_dashboard');
		}
		$this->independentPage('Master Navigation', '<b>Super Administrator</b> Management Module');
		Breadcrumb::add('Master Navigation');
		$this->enableGenesisController(true, true);
		$this->enableAddFormButton();
		$this->addManualOrderButton();
		$this->model    = new MasterNavigationModel;
		if($this->_act == null) {
			$this->model    = $this->model->orderBy('order_id');
        }

		return $this->init('core.master_navigation_grid');
	}

	protected function _fast_edit()
	{
		parent::_fast_edit();
		$attribute   	= Request::get('data');
		$log            = SoalModel::where('parent_id',$attribute['id'])->first();
        if ($log) {
			$log->{$attribute['field']} = (int)$attribute['value'];
			$log->save();
        } else {
            $newlog            = new SoalModel;
			$newlog->{$attribute['field']} = (int)$attribute['value'];
			$newlog->parent_id = $attribute['id'];
			$newlog->save();
        }
		console.log($attribute);
		return response()->json(["status" => true, "message" => "Your changes have been saved successfully.", "current"=>$attribute['value'], "next"=>!$attribute['value']]);

	}
    

	public function _createDefaultPermission($data) {
		if ($data->left(route,5)=='soal_') {
			console.log('berhasil');
		}
        // $log            = new SoalModel;
        // $log->parent_id = $data->id;
        // $log->detail    = '0';
        // $log->publish   = $data->publish;
        // $log->save();
    }


	public function navigation($masterNav, $nav=false) {
		if(Auth::guard('admin')->user()->position_id != 1) {
			return route('admin_dashboard');
		}

		$mnav   = MasterNavigationModel::find($masterNav);
		if(!$mnav) {
			Alert::add('Wrong Master Navigation Selected');
			return redirect()->route('_core_apps_master_navigation');
		}
		$this->independentPage('Navigation', '<b>Super Administrator</b> Management Module');
		Breadcrumb::add('Master Navigation', route('_core_apps_master_navigation'));
		Breadcrumb::add($mnav->name, route('_core_apps_master_navigation_detail', $mnav->id));

		$this->model    = new NavigationModel;
		if($nav === false) {
			if($this->_act == null) {
				$this->model    = $this->model->where('master_navigation_id', $mnav->id)
					->where('parent_id', 0)->orderBy('order_id');
			}
			$this->data['parent_id']    = false;
			$this->set_page_title($mnav->name);

			$this->data['enableTree'] = true;
		} else {
			$parent = NavigationModel::find($nav);
			if(!$parent) {
				Alert::add('Wrong Parent Navigation selected');
				return redirect()->route('_core_apps_master_navigation');
			}

			Breadcrumb::add($parent->menu);
			if(!$parent->rawParent) {
				$this->data['enableTree'] = false;
			} else {
				$this->data['enableTree'] = true;
			}

			if($this->_act == null) {
				$this->model = $this->model->where('master_navigation_id', $mnav->id)
					->where('parent_id', $parent->id)->orderBy('order_id');
			}
			$this->data['parent_id']    = $parent->id;
			$this->set_page_title($parent->menu);
		}

		$this->data['mnavid'] = $mnav->id;
		$this->enableGenesisController(true, true);
		$this->addManualOrderButton();
		$this->enableAddFormButton();
		

		$this->before_delete    = '_deleteNavigation';
		return $this->init('core.nav_grid');
	}

	protected function _deleteNavigation($record) {
		if($record->id == 1) {
			Alert::add('You cannot delete Dashboard.');
			return false;
		}
		if($record->subNav()->count()) {
			Alert::add('You must delete theirs tree first before you can delete this data');
			return false;
		}

		PermissionModel::where('navigation_id', $record->id)->delete();
		return true;
	}

	public function navigationPermission($navID) {
		$navigation     = NavigationModel::find($navID);
		if(!$navigation) {
			Alert::add('Wrong Navigation selected');
			return redirect()->back();
		}
		if(Request::has('_token')) {
			return $this->_saveNavigationPermission($navigation);
		}
		$action     = explode(';', $navigation->menu_action);
		$default    = json_decode($navigation->menu_default);
		$special    = explode(';', $navigation->special_permission);

		$this->data['menu']     = [
			'action'=>$action,
			'default'=>$default,
			'special'=>$special
		];

		$this->set_page_title($navigation->menu.' Permission');
		if($navigation->subNav()->count())
			$route  = route('_core_apps_navigation_detail', [$navigation->master_navigation_id, $navigation->id]);
		else $route = route('_core_apps_master_navigation_detail', $navigation->id);
		$this->data['back_url'] = $route;
		Breadcrumb::add($navigation->menu, $route);
		Breadcrumb::add('Permission');
//        dd($this->data['menu']);

		return $this->render_view('core.navigation_permission');
	}

	private function _saveNavigationPermission($nav) {
		$input  = Request::all();

		$nav->menu_action   = '';
		$nav->menu_default  = '';
		$nav->special_permission    = '';

		$permissionBlank    = [
			'permission_menu_default'   => '',
			'permission_menu_action'    => '',
			'special_permission'        => ''
		];
		PermissionModel::where('navigation_id', $nav->id)->update($permissionBlank);

		$menuDefault    = [];
		if(Request::has('order')) {
			$menuDefault['order']   = [
				'type'=>'order',
				'image'=>'fa-sort-alt'
			];
		}
		if(Request::has('add')) {
			$menuDefault['add'] = [
				'image'=>'fa-plus',
				'type'=>'form'
			];
		}
		$menuDefault    = json_encode($menuDefault);

		$menuAction = [];
		if(Request::has('action')) {
			foreach($input['action'] as $action=>$on) {
				array_push($menuAction, $action);
			}
		}
		$menuAction = implode(';', $menuAction);

		$specialPermission  = [];
		if(Request::has('special_permission')) {
			foreach($input['special_permission'] as $sp) {
				array_push($specialPermission, $sp);
			}
		}
		$specialPermission  = implode(';', $specialPermission);

		$nav->menu_action   = $menuAction;
		$nav->menu_default  = $menuDefault;
		$nav->special_permission    = $specialPermission;

		$nav->save();

		Alert::add('Your changes have saved successfully. <b><small>* all permission has been reset, please re-assign all</small></b>', 'success');
		return redirect()->back();
	}

    private function enableGenesisController($edit=false, $delete=false) {
        $this->setFastEdit(true);

        if($edit) Auth::guard('admin')->user()->__role->get('menu_action')[]  = 'edit';
        if($delete) Auth::guard('admin')->user()->__role->get('menu_action')[]  = 'delete';
    }

    private function enableAddFormButton() {
        $this->addDefaultButton('add', [
            'type'=>'form',
            'image'=>'fa fa-plus'
        ]);
    }

}