<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 19/11/20
 * Time: 15.04
 */
namespace App\Modules\Frontend\Controllers;

use App\Modules\Frontend\Models\TransactionDetailModel;
use Illuminate\Support\Facades\Request;

class APiGateway extends Controller {
    public function customerGetWaybill() {
        if(Request::has('target') && Request::has('result') && Request::has('key')) {
            $input  = Request::all();

            $phone  = $input['result'];
            $targetID   = $input['target'];

            $transaction    = TransactionDetailModel::where('customer_phone', $phone)->where('status_id', '>=', 5)
                ->find($targetID);
            if(!$transaction) {
                return $this->respond_json(false, "No handphone tidak ditemukan.");
            }
            $view   = view('widgets.view_waybill', ["transaction"=>$transaction])->render();

            return $this->respond_json(true, "Berhasil", $view);
        }
        return $this->respond_json(false, "oops. Illegal access");
    }

    protected function respond_json($status = false, $message = "", $others = "") {
        return response()->json(["status"=>$status, "message"=>$message, "others"=>$others]);
    }

}