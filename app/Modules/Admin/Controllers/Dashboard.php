<?php
/**
 * Created by PhpStorm.
 * User: Kim
 * Date: 6/22/2015
 * Time: 2:25 PM
 */
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\CustomerModel;
use App\Modules\Admin\Models\StoreModel;
use App\Modules\Admin\Models\SupplierModel;
use App\Modules\Admin\Models\MasterSKUModel;
use App\Modules\Admin\Models\SalesmanModel;
use App\Modules\Admin\Models\PurchaseOrderHeaderModel;
use App\Modules\Admin\Models\SalesOrderHeaderModel;

use App\Modules\Admin\Models\Views\ViewTopSalesmanModel;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class Dashboard extends GenesisController {
    public function __construct() {
        parent::__construct();
        $this->middleware('admin_role:dashboard');
        $this->set_page_title("Dashboard");
        $this->set_page_subtitle("Dashboard");
    }

    public function index() {
        return $this->render_view('dashboard');
    }
}