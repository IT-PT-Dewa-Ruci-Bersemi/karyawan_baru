<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 17:04
 */
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\ConfigModel;
use App\Modules\Libraries\Alert;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class Configs extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:configs');
        parent::__construct();
        $this->set_page_title('Website Configurations');
        $this->model    = new ConfigModel;
    }


    public function index() {
        $this->removeActionButtonAndSendToData('edit');

        $config = $this->model->all();

        $tempData   = [];

        foreach($config as $key => $conf) $tempData[$conf->name] = $conf->value;

        $this->data['config']   = $tempData;

        return $this->render_view('configs.global_config');
    }

    public function _save() {
        if(Request::has('_token')) {
            $valid  = $this->removeActionButtonAndSendToData('edit');
            if(!$valid) {
                Alert::add('You dont have permission to change this');
                return redirect()->back();
            }

            $input  = Request::all();
            $tab    = $input['_tab'];
            unset($input['_token']);
            unset($input['_tab']);


            foreach($input as $name=>$value) {
                ConfigModel::where('name', $name)->update(['value' => $value]);
            }

            Alert::add('Your changes have been saved successfully', 'success');
            return Redirect::route('admin_config', ['#'.$tab]);
        }

        return Redirect::route('admin_not_authorized');
    }

    public function _resetCache() {
        Cache::flush();
        Alert::add('Successfully refresh your cache', 'success');
        return redirect()->route('admin_personal_setting');
    }
}