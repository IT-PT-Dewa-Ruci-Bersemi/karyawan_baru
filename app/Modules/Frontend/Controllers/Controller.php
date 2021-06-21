<?php

namespace App\Modules\Frontend\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Request;


class Controller extends BaseController
{
    public $data            = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        //Global Number
        $no = 1;
        if (Request::has('page')){
            $no = Request::input('page') * 10 - 9;
        }
        $this->data['no']       = $no;
        $this->data['my_ip']    = $_SERVER['REMOTE_ADDR'];
    }

    public function render_view($view = ''){
        $data = $this->data;
        if($this->data['maintenance_mode'] == 'y'){
            $whitelist  = explode(',',$this->data['whitelist_ip']);
            if(!in_array($this->data['my_ip'], $whitelist)){
                return view('pages.maintenance',$data);       
            }
        }

        return view($view, $data);
    }
}
