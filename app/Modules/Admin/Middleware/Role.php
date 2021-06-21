<?php
/**
 * Created by PhpStorm.
 * User: kim
 * Date: 13/08/2017
 * Time: 22:27
 */

namespace App\Modules\Admin\Middleware;

use App\Modules\Admin\Models\NavigationModel;
use App\Modules\Libraries\Alert;
use App\Modules\Libraries\Breadcrumb;
use Closure;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $page=false, $independent=false)
    {
        $user   = Auth::guard('admin')->user();
        $independent    = (int)$independent;

        if($page===false) {
            view()->share('die_msg', "Wrong page's permalink.");
            echo view::make('admin::templates.blank_error')->render();
            die();
        }
        $parentPage = false;
        $menuAction             = [];
        $permissionMenuDefault  = [];
        $_pageMenuDefault       = [];
        $menuDefault            = [];
        $specialPermission      = [];
        $allowFastEdit          = [];
        $menuDefaultSort        = 0;
        $menu_default           = null;

        $permission         = $user->position->permission();
        $dataPermission     = $permission->pluck('navigation_id')->all();
        if(!$independent) {
            $currentPage = NavigationModel::where('publish', 1)->where('name', $page)->first();

            if($currentPage) {
                Breadcrumb::add($currentPage->menu, route($currentPage->route));
                $parentPage = NavigationModel::where('publish', 1)->where('id', $currentPage->parent_id)->first();
            } else return $this->notAuthorize();

            $_menu              = $permission->where('navigation_id', $currentPage->id)->first();



            if($_menu) {
                $menuAction             = $_menu->permission_menu_action != '' ? explode(';', $_menu->permission_menu_action) : [];
                $permissionMenuDefault  = $_menu->permission_menu_default != '' ? explode(';', $_menu->permission_menu_default) : [];
                $_pageMenuDefault       = json_decode($currentPage->menu_default);
                $temp                   = [];
                foreach($permissionMenuDefault as $s) {
                    if(isset($_pageMenuDefault->$s)) $temp[$s] = $_pageMenuDefault->$s;
                }

                if(isset($temp['order'])) $menuDefaultSort  = 1;
                else $menuDefaultSort   = 0;

                $menu_default       = $temp;
                $specialPermission  = $_menu->special_permission != '' ? explode(';', $_menu->special_permission) : [];
                $allowFastEdit      = in_array('fast_edit', $menuAction);
            } else return $this->notAuthorize();
        } else {
            $currentPage    = (object)['name'=>null];
            $parentPage     = (object)['id'=>null];
        }

        $allRoleData    = collect([
            'user'                  => $user,
            'current_page'          => $currentPage,
            'parent_page'           => $parentPage,
            'menu_default'          => collect($menu_default),
            'menu_action'           => collect($menuAction),
            'special_permission'    => collect($specialPermission),
            'allow_fast_edit'       => $allowFastEdit,
            'menu_default_sort'     => $menuDefaultSort,
            'permission'            => $dataPermission,
        ]);
        $user->__role   = $allRoleData;

        return $next($request);
    }

    private function notAuthorize() {
        Alert::add('You don\'t have permission to access that page');
        return redirect()->route('admin_dashboard');
    }
}
