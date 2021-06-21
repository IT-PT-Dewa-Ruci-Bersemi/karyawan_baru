<?php

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\CellGroupModel;
use App\Modules\Admin\Models\ProductModel;
use App\Modules\Admin\Models\ProductStockModel;
use App\Modules\Admin\Models\ProductStockLogModel;
use App\Modules\Admin\Models\MasterSKUModel;
use App\Modules\Admin\Models\SS\OnlineBookingAttendeeTempModel;
use App\Modules\Admin\Models\SS\OnlineBookingDetailModel;
use App\Modules\Admin\Models\SS\OnlineBookingHeaderModel;
use App\Modules\Admin\Models\SS\OnlineBookingUserModel;
use App\Modules\Admin\Models\SS\Views\ViewOnlineBookingAttendeeModel;
use App\Modules\Admin\Models\UnitModel;
use App\Modules\Admin\Models\AttributeModel;
use App\Modules\Admin\Models\CustomerModel;
use App\Modules\Admin\Models\SalesmanModel;
use App\Modules\Admin\Models\SupplierModel;
use App\Modules\Admin\Models\Views\ViewProductSalesModel;
use App\Modules\Admin\Models\Views\ViewSalesOrderModel;
use App\Modules\Admin\Models\StoreModel;
use App\Modules\Libraries\Alert;
use App\Modules\Admin\Models\SalesOrderHeaderModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Psy\Test\Exception\FatalErrorExceptionTest;

class Ajax extends GenesisController
{
//    public function getCustomer()
//    {
//        if (Request::has('param')) {
//            $param = Request::get('param');
//            $customer = CustomerModel::select(['id', 'name', 'email', 'address'])
//                ->where('name', 'like', '%' . $param . '%')->orWhere('email', 'like', '%' . $param . '%')->get()->toArray();
//            return response()->json($customer);
//        }
//    }
//
//    public function updateGiro()
//    {
//        $request    = Request::all();
//        $id     = $request['id'];
//        $data   = SalesOrderHeaderModel::where('id',$id)->where('payment_method_id',999)->where('giro_status',0)->firstOrFail();
//        $data->giro_status = 1;
//        $data->save();
//        return response()->json(['success' => true,'order_code' => $data->sales_order_code]);
//    }
}
