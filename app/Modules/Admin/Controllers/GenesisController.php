<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 7/16/2015
 * Time: 11:15 PM
 */
namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use App\Modules\Libraries\Alert;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class GenesisController extends AdminController {
    protected $user;

    protected $model;
    protected $viewModel    = null;

    protected $pk       = 'id';
    protected $_sort    = null;
    protected $_method  = null;
    protected $_filter  = null;
    protected $_urlFilter	= null;

    private $limit            = 20;
    private $orderBy          = [];
    private $curr_page        = 1;
    private $allow_fast_edit  = null;
    protected $remove_menu_action     = [];
    private $remove_menu_default    = [];
    private $menu_default           = [];
    private $remove_special_permission  = [];

    protected $before_delete    = null;
    protected $before_save      = null;
    protected $after_save       = null;

    protected $_redirect        = null;
    protected $_act             = null;
    protected $_act_id          = null;

    protected $field            = null;

    protected $bool_breadcrumb  = true;//_bool_breadcrumb

    public function __construct(){
        parent::__construct();
        if(Request::has('act')) $this->_act = Request::input('act');

        $this->start_up();
        $this->_js_start();
        $this->middleware(function ($request, $next) {
            $this->setGlobalParam();
            return $next($request);
        });
    }

    protected function setGlobalParam(){}

    private function start_up() {
        $this->data['master_nav']   = $this->masterNav;
        $this->data['page_title']   = '';
        $this->data['curr_page']    = $this->curr_page;
        $this->data['page_title']   = '';
        $this->data['page_subtitle']= 'Management Area';
        $this->data['_bool_breadcrumb'] = $this->bool_breadcrumb;
    }

    private function _js_start() {
        if(Request::has('sort')) {
            $this->_sort    = Request::input('sort');
            $this->_method  = Request::input('method');
            $this->data['_sort']    = $this->_sort;
            $this->data['_method']  = $this->_method;
        }
        if(Request::has('_filter')) {
            $request    = Request::all();

            if($this->_sort) {
                unset($request['sort']);
                unset($request['method']);
            }
            $this->_urlFilter	= http_build_query($request);
            unset($request['_filter']);

            foreach($request as $key=>$value) {
                $temp   = explode('_', $key);
                $ftype  = $temp[0];
                unset($temp[0]);
                $temp           = implode('_', $temp);
                if($temp != '')
                    $request[$temp] = $value != '' ? ['value'=>$value,'type'=>$ftype] : ['value'=>'', 'type'=>null];
                unset($request[$key]);
            }
            $this->_filter          = $request;
            $this->data['_filter']  = $request;
            $this->data['_filter_url']	= $this->_urlFilter;
        }
    }

    protected function get_list($id = '') {
        if($this->viewModel == null) {
            $this->viewModel    = $this->model;
        }
        if($id != '') return $this->viewModel->find($id);

        if($this->_filter != null) {
            foreach($this->_filter as $key=>$value) {
                if($value['type'] == 'qt') {//for input text
                    $searchText = $value['value'];
                    $searchText = explode(' ', $searchText);
                    if(count($searchText) > 1) {
                        $this->viewModel    = $this->viewModel->where(function ($query) use ($key, $searchText) {
                            foreach($searchText as $text) {
                                $query->where($key, 'like', '%'.$text.'%');
                            }
                        });
                        $this->viewModel    = $this->viewModel->orWhere($key, 'LIKE', '%' . $value['value'] . '%');
                    } else $this->viewModel = $this->viewModel->where($key, 'LIKE', '%' . $value['value'] . '%');
                } else if($value['type'] == 'qs') // for select
                    $this->viewModel    = $this->viewModel->where($key, '=', $value['value']);
            }
        }

        if($this->_sort != null && $this->_method != null)
            $this->viewModel = $this->viewModel->orderBy($this->_sort, $this->_method);
        else if(is_array($this->orderBy) && count($this->orderBy)) {
            foreach($this->orderBy as $key => $value) {
                $this->viewModel    = $this->viewModel->orderBy($key, $value);
            }
        } else if(!is_array($this->orderBy) && $this->orderBy != '') {
            $this->viewModel    = $this->viewModel->orderBy($this->orderBy);
        }

        $this->setLoadDataWith();

        return $this->viewModel->paginate($this->limit);
    }

    protected function setLoadDataWith() {}

    protected function set_page_title($page_title) {
        $this->data['page_title']   = $page_title;
        return true;
    }

    protected function set_page_subtitle($sub) {
        $this->data['page_subtitle']    = $sub;
    }

    public function init($view) {
        $status = true;

        if($this->_act == 'add') {
            $status = $this->_add();
        } else if($this->_act == 'edit') {
            $status = $this->_edit();
        } else if($this->_act == 'delete') {
            if(Request::has('id')) {
                $this->_act_id  = Request::input('id');
                $status = $this->_delete();
            }
        } else if($this->_act == 'order') {
            return $this->_order();
        } else if($this->_act == 'fast_edit') {
            return $this->_fast_edit();
        }
        if(!$status) return Redirect::to($this->_redirect);

        if($this->model != '') {
            if((empty($this->_act) || $this->_act == '')) {
                $this->data['records']      = $this->get_list();

                $paginate   = str_replace('/?', '?', $this->data['records']->appends(Request::all())->render());
                $paginate   = preg_replace('~>\s+<~', '><', $paginate);
                $paginate   = rtrim($paginate);
                $this->data['pagination']   = $paginate;
                $this->data['total_data']   = $this->viewModel->count();
            } else if(!empty($this->_act_id) || $this->_act_id != '') {
                $this->data['record']       = $this->get_list($this->_act_id);
            }
        } else {
            return $this->_die('model');
        }
        if($this->_redirect) return Redirect::to($this->_redirect);
        return $this->render_view($view);
    }

    protected function _set_up($index, $value) {
        $this->data[$index] = $value;
    }

    protected function _fast_edit() {
        if($this->allow_fast_edit === null) {
            $this->allow_fast_edit  = Auth::guard($this->provider)->user()->__role->get('allow_fast_edit');
        }

        if($this->allow_fast_edit) {
            $attribute   = Request::get('data');
            if ($this->model != '') {
                $this->model    = $this->model->find($attribute['id']);
                if($this->model) {
                    $this->model->{$attribute['field']} = (int)$attribute['value'];
                    $status = $this->model->save();

                    if ($status) {
                        return response()->json(["status" => true, "message" => "Your changes have been saved successfully.", "current"=>$attribute['value'], "next"=>!$attribute['value']]);
                    } else return response()->json(["status" => false, "message" => "There is something wrong, please try again."]);
                } else return response()->json(['status'=>false, 'message'=>'Oops. No record has been found. Please try again.']);
            } else $this->_die('model');
        } else {
            return response()->json(['status'=>false, 'message'=>'You have no authorize to change this']);
        }
    }

    protected function _add() {
        $input  = Request::all();
        $this->_redirect    = URL::previous();
        if(Request::has('_token')) {
            unset($input['_token']);
            unset($input['act']);

            $tempFiles  = [];
            if(isset($input['_total_files'])) {
                $totalFile  = $input['_total_files'];
                unset($input['_total_files']);

                for($a = 1;$a<=$totalFile;$a++) {
                    $fieldName  = $input['_file_name-'.$a];
                    $valid      = Schema::hasColumn($this->model->getTable(), $fieldName);
                    if(!$valid) {
                        Alert::add('Wrong field name "'.$fieldName.'"');
                        return false;
                    }
                    if(!isset($input['_file-'.$a])){
                        unset($input['_file_name-'.$a]);
                        unset($input['_file_path-'.$a]);
                        unset($input['_file_ext-'.$a]);
                        unset($input['_file-'.$a]);
                        continue;
                    }
                    $file       = $input['_file-'.$a];
                    if(isset($input['_file-ext-'.$a])) {
                        $ext = $file->getClientOriginalExtension();
                        $allowedExt = $input['_file-ext-' . $a];
                        $allowedExt = explode('|', $allowedExt);
                        if (!in_array($ext, $allowedExt)) {
                            Alert::add($fieldName . ' extension not allowed');
                            return false;
                        }
                    }
                    $filePath   = $input['_file_path-'.$a];
                    $random     = Str::random(5);
                    $fileName   = strtolower(str_replace(' ', '', $file->getClientOriginalName()));
                    array_push($tempFiles, [
                        'path'      =>$filePath,
                        'file'      =>$file,
                        'name'      =>$random.$fileName
                    ]);
                    $input[$fieldName]  = $random.$fileName;

                    unset($input['_file_name-'.$a]);
                    unset($input['_file_path-'.$a]);
                    unset($input['_file_ext-'.$a]);
                    unset($input['_file-'.$a]);
                }
            }
            if(method_exists($this->model, 'validate')) {
                $respond = $this->model->validate($input);
                if (!$respond) {
                    $errors = $this->model->getValidationError();
                    foreach ($errors->all() as $list)
                        Alert::add($list);
                    return false;
                }
                unset($this->model->createRules);
                unset($this->model->editRules);
            }

            if (isset($input['_permalink']) && !isset($input['permalink'])) {
                $permaField = $input['_permalink'];
                $permalink = $this->_generate_permalink($input[$permaField]);
                unset($input['_permalink']);
                $input['permalink'] = $permalink;
            }

            foreach ($input as $key => $value) {
                $this->model->{$key} = $value;
            }

            $do_save    = true;
            if($this->before_save) $do_save = $this->_callback($this->model, $this->before_save);

            if($do_save) {
                foreach($tempFiles as $file) {
                    $file['file']->move($file['path'], $file['name']);
                }

                $status = $this->model->save();
            } else return false;

            if ($status) {
                if($this->after_save) $this->_callback($this->model, $this->after_save);
                Alert::add('Successfully add new row', 'success');
            } else {
                foreach($tempFiles as $file) {
                    if(file_exists(public_path($file['path'].$file['old']))) {
                        unlink(public_path($file['path'].$file['old']));
                    }
                }

                Alert::add('Error occured when saving your changes. Please try again or contact your developer');
                return false;
            }
        }
        return true;
    }

    protected function _edit() {
        $input      = Request::all();
        $do_save    = true;
        $temporaryFiles     = [];
        $this->_redirect    = URL::previous();

        if(Request::has('_token') && Request::has('id')) {
            $id = $input['id'];
            unset($input['_token']);
            unset($input['act']);
            unset($input['id']);

            if(method_exists($this->model, 'validate')) {
                $respond = $this->model->validate($input, true, $id);
                if (!$respond) {
                    $errors = $this->model->getValidationError();
                    foreach ($errors->all() as $list)
                        Alert::add($list);
                    return false;
                }
                unset($this->model->createRules);
                unset($this->model->editRules);
            }

            $this->model = $this->model->find($id);
            if(!$this->model) {
                Alert::add('You have selected wrong item');
                return false;
            }

            if (isset($input['_permalink']) && !isset($input['permalink'])) {
                $permaField = $input['_permalink'];
                $permalink = $this->_generate_permalink($input[$permaField], $id);
                unset($input['_permalink']);
                $input['permalink'] = $permalink;
            }

            if(isset($input['_total_files'])) {
                $totalFile  = $input['_total_files'];
                unset($input['_total_files']);

                for($a = 1;$a<=$totalFile;$a++) {
                    $fieldName  = $input['_file_name-'.$a];
                    $valid      = Schema::hasColumn($this->model->getTable(), $fieldName);
                    if(!$valid) {
                        Alert::add('Wrong field name "'.$fieldName.'"');
                        return false;
                    }
                    if(!isset($input['_file-'.$a])) {
                        unset($input['_file_name-'.$a]);
                        unset($input['_file_path-'.$a]);
                        unset($input['_file_ext-'.$a]);
                        unset($input['_file-'.$a]);
                        continue;
                    }
                    $file       = $input['_file-'.$a];
                    if(isset($input['_file-ext-'.$a])) {
                        $ext = $file->getClientOriginalExtension();
                        $allowedExt = $input['_file-ext-' . $a];
                        $allowedExt = explode('|', $allowedExt);
                        if (!in_array($ext, $allowedExt)) {
                            Alert::add($fieldName . ' extension not allowed');
                            return false;
                        }
                    }
                    $filePath   = $input['_file_path-'.$a];
                    $random     = Str::random(5);

                    $fileName   = strtolower(str_replace(' ', '', $file->getClientOriginalName()));
                    $input[$fieldName]  = $random.$fileName;

                    array_push($temporaryFiles, [
                        'path'=>$filePath,
                        'name'=>$random.$fileName,
                        'old'=>$this->model->{$fieldName}
                    ]);

                    unset($input['_file_name-'.$a]);
                    unset($input['_file_path-'.$a]);
                    unset($input['_file_ext-'.$a]);
                    unset($input['_file-'.$a]);
                }
            }

            foreach ($input as $key => $value) {
                $this->model->{$key} = $value;
            };

            if($this->before_save) $do_save = $this->_callback($this->model, $this->before_save);
            if (!$do_save) return false;

            if($do_save) {
                foreach($temporaryFiles as $target) {
                    if($target['old'] != '' || $target['old'] != null) {
                        if(file_exists(public_path($target['path'].$target['old']))) {
                            unlink(public_path($target['path'].$target['old']));
                        }
                    }

                    $file->move($target['path'], $target['name']);
                }

                $status = $this->model->save();
            } else $status = false;

            if ($status) {
                if($this->after_save) $this->_callback($this->model, $this->after_save);

                Alert::add('Your changes has been saved successfully', 'success');
            } else {
                Alert::add('Error occured when saving your changes. Please try again or contact your developer');
                return false;
            }
        }
        return true;
    }

    protected function _delete() {
        if(Request::has('_token')) {
            $model = $this->model->find($this->_act_id);
            if ($model) {
                $do_delete  = true;
                if($this->before_delete) $do_delete = $this->_callback($model, $this->before_delete);

                if($do_delete) {
                    $model->delete();
                    Alert::add('Successfully removed selected item', 'success');
                }
                $this->_redirect = URL::previous();
                return true;
            } else return false;
        }
        return false;
    }

    protected function _order() {
        if(Request::has('_token')) {
            $data   = Request::get('data');
            foreach($data as $index=>$id) {
                $this->model            = $this->model->find($id);
                $this->model->order_id  = $index;
                $this->model->save();
            }
            Alert::add('Your order have saved successfully', 'success');
            return response()->json(["status"=>true]);
        }
        Alert::add('Error occured while saving. Please refresh and try again.');
        return response()->json(["status"=>false]);
    }

    private function _callback($value, $method) {
        if(!empty($method)) {
            if(function_exists($method)) {
                $value  = call_user_func_array($method, [&$value]);
            }else if(method_exists($this, $method)) {
                $value  = call_user_func_array([$this,$method], [&$value]);
            } else {
                Alert::add('Method '.$method." does not exists!", 'warning');
                return false;
            }
        }
        return $value;
    }

    protected function _generate_permalink($value, $edit_id = 0, $field = 'permalink')
    {
        $permalink  = Str::slug($value);
//        $list       = $this->model->where($this->pk, '!=', $edit_id)->where($field,'regexp', new \MongoDB\BSON\Regex('^{$permalink}(-[0-9]*)?$'))->get();
        $list       = $this->model->where('id', '!=', $edit_id)->whereRaw($field." REGEXP '^{$permalink}(-[0-9]*)?$'")->get();
        $count      = $list->count();

        $exist      = false;
        $tempExist  = 0;
        if($count > 0) {
            for($i=1;$i<=$count;$i++) {
                if($i == 0) $compare = $permalink;
                else $compare = $permalink."-".$i;

                foreach($list as $el) {
                    if($el->permalink == $compare) {
                        $exist = true;
                        $tempExist  = $i;
                    }
                }

                if(!$exist) {
                    $permalink = $compare;
                    break;
                }
            }
        }

        if($exist) {
            if($tempExist > 0) $permalink  = $permalink.'-'.($tempExist+1);
        }
        return $permalink;
    }

    protected function setMenuDefaultSort($bool = true) {
        $this->data['menu_default_sort']    = $bool ? 1 : 0;
        if($bool == false) {
            $this->removeDefaultButton('order');
        }
        return;
    }

    protected function removeDefaultButton($menu) {
        array_push($this->remove_menu_default, $menu);
        return;
    }

    protected function addDefaultButton($name, $data) {
        $menuDefault    = Auth::guard($this->provider)->user()->__role->get('menu_default');
        if(isset($menuDefault[$name])) {
            $this->_die("default_menu");
        }
        $this->menu_default[$name] = json_decode(json_encode($data));
        return true;
    }

    protected function enableAddDefaultButton() {
        $this->addDefaultButton('add', [
            'type'=>'form',
            'image'=>'fa-plus'
        ]);
        return;
    }

    protected function enableSortDefaultButton() {
        $this->addDefaultButton('Order', [
            'type'=>'order',
            'image'=>'fa-bars'
        ]);
        return;
    }

    protected function addBackButton($route) {
        $this->addDefaultButton('Back', [
            'type'=>'link',
            'image'=>'fa-arrow-left',
            'route'=>$route
        ]);
        return true;
    }

    protected function removeActionButtonAndSendToData($actionButton) {
        $role   = Auth::guard($this->provider)->user()->__role->get('menu_action');

        if($role->contains($actionButton)) {
            array_push($this->remove_menu_action, $actionButton);
            $this->data[$actionButton]  = true;
            return true;
        } else {
            $this->data[$actionButton]  = false;
            return false;
        }
    }

    protected function enableEditDefaultActionButton() {
        $role   = Auth::guard($this->provider)->user()->__role->get('menu_action');
        if(!$role->contains('edit')) {
            $role->push('edit');
            return true;
        }
        return false;
    }

    protected function checkSpecialPermissionAndSendToData($specialPermission) {
        $role   = Auth::guard($this->provider)->user()->__role;

        if($role->get('special_permission')->contains($specialPermission)) {
            $this->data[$specialPermission]  = true;
            return true;
        } else {
            $this->data[$specialPermission] = false;
            return false;
        }
    }

    protected function checkPermission($permission) {
        $role   = Auth::guard($this->provider)->user()->__role;
        if($role->get('menu_action')->contains($permission)) return true;
        else if($role->get('special_permission')->contains($permission)) return true;
        else return false;
    }

    protected function setFastEdit($bool) {
        $this->allow_fast_edit  = $bool;
    }

    protected function setOrderBy($field, $method = 'asc') {
        $this->orderBy[$field]  = $method;
    }

    private function _die($index) {
        $err    = [
            "404"   => "Page not found.",
            "401"   => "Unauthorized to access this page.",
            "page"  => "Wrong page's permalink.",
            "model" => "There is no model found",
            "default_menu"  => "Your Default Menu is duplicate"
        ];
        $this->data['page_title']       = 'Missing Page';
        $this->data['page_subtitle']    = 'There is something occurred, either the script or you enter missing Page';
        $this->data['die_msg']  = '<center style="font-family: arial;font-size: 11px;">'.$err[$index].'<center>';
        $this->_set_up('_bool_breadcrumb', false);

        return $this->render_view('templates.error');
    }

    protected function respond_json($status = false, $message = "", $others = "") {
        return response()->json(["status"=>$status, "message"=>$message, "others"=>$others]);
    }

    protected function renderRespond($message, $error=true) {
        $data   = [
            'message'   => $message,
            'error'     => $error
        ];
        return view($this->provider.'::includes.respond', $data)->render();
    }

    protected function _get_filter_select($model, $showValue, $hiddenValue = 'id') {
        $data       = $model->select([$hiddenValue, $showValue]);
        $data       = $data->get();
        $temp       = [];
        foreach($data as $list) {
            array_push($temp, ["display"=>$list->$showValue,"value"=>$list->$hiddenValue]);
        }
        return $temp;
    }

    protected function setUpEmailData($headerTitle) {
        $email  = [];
        $email['website_logo']  = $this->data['website_logo'];
        $email['header_title']  = $headerTitle;
        return $email;
    }

    protected function alertError($errors) {
        foreach($errors as $error) {
            Alert::add($error);
        }
    }

    protected function addManualOrderButton() {
        $this->data['menu_default_sort']    = true;
        $this->addDefaultButton('Order', [
            'type'=>'order',
            'image'=>'fa-bars'
        ]);
    }

    protected function render_view($view, $render = false) {
        $role   = Auth::guard($this->provider)->user()->__role;
        $this->data['__role']               = $role;
        $this->data['menu_default']         = array_merge($this->menu_default, $this->data['__role']->get('menu_default')->except($this->remove_menu_default)->toArray());
        $this->data['menu_default_sort']    = isset($this->data['menu_default_sort']) ? $this->data['menu_default_sort'] : $role->get('menu_default_sort');
        $this->data['menu_action']          = array_values($role->get('menu_action')->filter(function ($value, $key) {
            return !array_keys($this->remove_menu_action, $value);
        })->toArray());

        if($render) return view::make($this->provider.'::'.$view, $this->data)->render();
        return view::make($this->provider.'::'.$view, $this->data);
    }

    protected function ip_in_range( $ip, $min, $max ) {
        return (ip2long($min) <= ip2long($ip) && ip2long($ip) <= ip2long($max));
    }

    protected function cleanString($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

}
