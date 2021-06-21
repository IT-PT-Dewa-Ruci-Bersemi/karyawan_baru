<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 23/02/2018
 * Time: 11:14
 */
namespace App\Modules\Admin\Controllers\Core;

use App\Modules\Admin\Controllers\GenesisController;
use App\Modules\Admin\Models\Core\DocsModel;
use App\Modules\Libraries\Alert;
use Illuminate\Support\Facades\Auth;

class Docs extends GenesisController {
	public function __construct()
	{
		$this->middleware('admin_role:system_docs');
		parent::__construct(false);
		$this->data['docs'] = DocsModel::where('publish', 1)->where('parent_id', 0)
			->orderBy('order_id')->get();
	}

	public function index() {
		$firstDocs  = $this->data['docs']->first();
		if(!$firstDocs) {
			Alert::add('Our Docs has not ready yet.');
			return redirect()->route('admin_dashboard');
		}
		if($firstDocs->children(1)->count()) {
			$firstDocs  = $firstDocs->children(1)->first();
		}
		return redirect()->route('admin_system_docs_detail', $firstDocs->permalink);
	}

	public function detail($permalink) {
		$detail = DocsModel::where('permalink', $permalink)->where('publish', 1)->first();
		if(!$detail) {
			Alert::add('Wrong data selected.');
			return redirect()->route('admin_system_docs');
		}
		if($detail->children(1)->count()) {
			return redirect()->route('admin_system_docs_detail', $detail->children(1)->first()->permalink);
		}

		$this->data['detail']   = $detail;

		return $this->render_view('core.docs_templates.docs');
	}
}