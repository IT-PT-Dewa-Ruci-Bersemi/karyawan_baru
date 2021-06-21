<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 22/02/2018
 * Time: 13:23
 */
namespace App\Modules\Admin\Controllers\Core;

use App\Modules\Admin\Controllers\GenesisController;
use App\Modules\Admin\Models\Core\DocsModel;
use App\Modules\Libraries\Alert;
use App\Modules\Libraries\Breadcrumb;
use Illuminate\Support\Facades\Auth;

class CoreDocs extends GenesisController {
	public function __construct()
	{
		$this->middleware('admin_role:false,1');
		parent::__construct();
		set_time_limit(1000000);
	}

	public function index($id=false) {
		if(Auth::guard('admin')->user()->position_id != 1) {
			return route('admin_dashboard');
		}

		$this->independentPage('Docs', '<b>Super Administrator</b> Management Module');
		$this->enableAddFormButton();
		$this->enableGenesisController(true, true);
		$this->addManualOrderButton();
		$this->model    = new DocsModel;

		Breadcrumb::add('Documentation', route('_core_apps_docs'));
		if($id != false) {
			$parent = DocsModel::find($id);
			if(!$parent) {
				Alert::add('Wrong Parent Selected');
				return redirect()->route('_core_apps_docs');
			}

			if($parent->parent) {
				Alert::add('Only 1 level allowed');
				return redirect()->route('_core_apps_docs');
			}

			if($this->_act == null) {
				$this->model    = $this->model->where('parent_id', $id)->orderBy('order_id');
			}

			$detail = false;
			$parentID = $parent->id;
			Breadcrumb::add($parent->menu.' Docs');
			$this->addDefaultButton('Back', [
				'type'=>'link',
				'route'=>'_core_apps_docs',
				'image'=>'fa-arrow-left'
			]);
		} else {
			$detail     = true;
			$parentID     = false;
			if($this->_act == null) {
				$this->model    = $this->model->where('parent_id', 0)->orderBy('order_id');
			}
		}

		$this->data['parent_id']    = $parentID;
		$this->data['view_detail']  = $detail;



		return $this->init('core.docs_grid');
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