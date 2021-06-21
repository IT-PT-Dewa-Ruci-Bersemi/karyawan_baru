<?php namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Models\AdministratorModel;
use App\Modules\Admin\Models\MasterNavigationModel;
use App\Modules\Admin\Models\NavigationModel;
use App\Modules\Libraries\Breadcrumb;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller as BaseController;
use App\Modules\Systems\Controllers\Systems;
use Illuminate\Support\Facades\Request;

class AdminController extends BaseController {
    public      $data           = array();
    public      $configType     = 'back';
    protected   $masterNav      = null;
    protected   $provider       = 'admin';
    protected   $prefixPath     = '_admin';

    public function __construct($loadNav=true) {
        $this->_setup_global($loadNav);
        $this->_start_up(Systems::load_config($this->configType, true));
    }


    protected function render_view($view, $render = false)
    {
        if($render) return view::make($this->provider.'::'.$view, $this->data)->render();
        return view::make($this->provider.'::'.$view, $this->data);
    }

    public function _setup_global($loadNav) {
        /**
         * Set Global Settings here
         * or you can fetch data from model here
         */
        //Global Number
        $no = 1;
        if (Request::has('page')){
            $no = Request::input('page') * 10 - 9;
        }
        $this->data['no'] = $no;

        if(env('APP_ENV') == 'local' || env('APP_ENV') == null) {
            $this->data['__admin_path']     = $this->prefixPath;
        } else {
            $this->data['__admin_path']     = '';
        }
        if($loadNav)
            $this->masterNav    = MasterNavigationModel::where('publish',1)->orderBy('order_id', 'asc')->get();
    }

    public function _start_up($config) {
        foreach($config as $key => $conf)
            $this->data[$key] = $conf;
    }

    protected function redirect_route($route, $data = []){
        return Redirect::route($route, $data);
    }

    public function independentPage($pageTitle, $pageSubtitle = '') {
        $role   = Auth::guard('admin')->user()->__role;

        $this->data['master_nav']           = $this->masterNav;
        $this->data['page_title']           = $pageTitle;
        $this->data['page_subtitle']        = $pageSubtitle;
        $this->data['_bool_breadcrumb']     = true;
        $this->data['__role']               = $role;
        $this->data['menu_default']         = $this->data['__role']->get('menu_default')->toArray();
        $this->data['menu_default_sort']    = $role->get('menu_default_sort');
        $this->data['menu_action']          = array_values($role->get('menu_action')->filter(function ($value, $key) {
            return !array_keys($this->remove_menu_action, $value);
        })->toArray());
    }
}