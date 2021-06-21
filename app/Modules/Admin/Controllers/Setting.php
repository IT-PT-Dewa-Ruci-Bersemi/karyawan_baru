<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 07/09/2017
 * Time: 18:17
 */
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\AdministratorModel;
use App\Modules\Libraries\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;

class Setting extends AdminController {

	public function __construct()
	{
		$this->middleware('admin_role:false,1');
		parent::__construct(true);
	}

	public function personal() {
		$this->independentPage('Personal Setting');
		if(Request::has('_token')) {
			$input          = Request::all();
			$currPassword   = $input['curr_password'];
			$newPassword        = $input['new_password'];
			$confirmPassword    = $input['confirm_new_password'];

			if($newPassword != $confirmPassword) {
				Alert::add('New Password and Confirm New Password do not match.');
				return redirect()->route('admin_personal_setting');
			}
			$user           = Auth::guard('admin')->user();
			$oldPassword    = $user->password;

			$bool   = Hash::check($currPassword, $oldPassword);
			if(!$bool) {
				Alert::add('Please input your current password correctly');
				return redirect()->route('admin_personal_setting');
			}

			$obj    = AdministratorModel::find($user->id);
			$obj->password  = $newPassword;
			$obj->save();


			Auth::guard('admin')->loginUsingId($user->id);

			Alert::add('Successfully saved your new password', 'success');
			return redirect()->route('admin_personal_setting');
		}

		return $this->render_view('administrator.personal_settings');
	}

}
