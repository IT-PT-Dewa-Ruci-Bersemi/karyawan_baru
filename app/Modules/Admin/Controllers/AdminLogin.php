<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 13/08/2017
 * Time: 14:48
 */
namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use App\Modules\Admin\Models\AdministratorModel;

class AdminLogin extends AdminController {

    public function __construct() {
        parent::__construct('login');
    }


    public function index() {
        if(Auth::guard('admin')->check()) return redirect()->route('admin_dashboard');
        return $this->render_view('login.login');
    }

    public function do_login(){
        if(Request::has('_token')){
            $rules = array(
                'username'    => 'required',
                'password' => 'required|min:3'
            );

            $validator = Validator::make(Request::all(), $rules);

            if ($validator->    fails()) {
                return redirect()->route('admin_login')->withErrors($validator);
            } else {
                $userdata = [
                    'username'  => Request::get('username'),
                    'password'  => Request::get('password'),
                    'active'    => 1
                ];
                if (Auth::guard('admin')->attempt($userdata)) {
                    Auth::guard('admin')->user()->last_login = new \DateTime();
                    Auth::guard('admin')->user()->save();

                    return redirect()->intended(route('admin_dashboard'));
                } else {
                    $errors = new MessageBag(['password' => ['Wrong username and password combination.']]);
                    return redirect()->route('admin_login')->withErrors($errors);
                }


            }
        }
        else {
            return redirect()->route('admin_login');
        }
    }

    public function do_logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }
}