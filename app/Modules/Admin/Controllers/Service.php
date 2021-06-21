<?php
/**
 * Created by PhpStorm.
 * User: echoinfinite
 * Date: 23/08/20
 * Time: 22.51
 */
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\CustomerModel;
use App\Modules\Admin\Models\MasterShipperModel;
use App\Modules\Admin\Models\TransactionDetailModel;
use App\Modules\Admin\Models\TransactionDetailQtyLogModel;
use App\Modules\Admin\Models\TransactionDetailStatusLogModel;
use App\Modules\Admin\Models\TransactionDetailStatusModel;
use App\Modules\Admin\Models\TransactionHeaderModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Symfony\Component\Console\Input\Input;

class Service extends AdminController {
    public function getCustomerAddress() {
        $input  = Request::all();
        if(Request::has('q')) {
            $keyword = $input['q'];

            $customers = CustomerModel::select(['id','name', 'instagram_name', 'phone_number', 'address'])
                ->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('instagram_name', 'like', '%' . $keyword . '%')->orWhere('phone_number', 'like', '%'.$keyword.'%')
                ->take(10)->get()->toArray();

            return $this->jsRespond(true, $customers);
        }
        return $this->jsRespond(false, 'Please put keyword(s)');
    }


    public function updateTransactionDetailStatus() {
        if(!Request::has('id') || !Request::has('header')) {
            return $this->jsRespond(false, 'Oops. Illegal move');
        }
        $input  = Request::all();
        $id     = $input['id'];
        $header = $input['header'];

        $transaction    = TransactionDetailModel::where('transaction_header_id', $header)->find($id);
        if(!$transaction) {
            return $this->jsRespond(false,'Oops. No Transaction found, please try again.');
        }
        if($transaction->status_id >= 5) {
            return $this->jsRespond(false, "This transaction has already been complete.");
        }

        $admin  = Auth::guard('admin')->user();

        $newStatus  = 0;
        if($transaction->status_id == 2) {
            $newStatus  = 3;
            //awating payment -> complete payment & preparing

        } else if($transaction->status_id == 3) {
            $newStatus  = 4;
            //complete Payment -> Preparing & Shipment

        } else if($transaction->status_id == 4) {
            if(!Request::has('shipper') || !Request::has('tracking_code')) {
                return $this->jsRespond(false, "Oops. You need to fill the shipment and tracking code.");
            }
            $shipperID  = $input['shipper'];
            $trackingCode   = $input['tracking_code'];

            $shipper    = MasterShipperModel::find($shipperID);
            if(!$shipper) {
                return $this->jsRespond(false, "oops No Shipper found, please try again.");
            }
            $newStatus  = 5;
            $transaction->shipper_id    = $shipperID;
            $transaction->tracking_code = $trackingCode;
            $transaction->manifest_history  = json_encode([]);
            //preparing -> Shipment
        }

        $transaction->status_id = $newStatus;
        $transaction->save();

        $log    = new TransactionDetailStatusLogModel;
        $log->transaction_detail_id = $transaction->id;
        $log->status_id             = $newStatus;
        $log->admin_id              = $admin->id;
        $log->save();

        $responseStatus = $this->prepareNextStatus($transaction);

        return $this->jsRespond(true, "Yeah", $responseStatus);
    }

    private function prepareNextStatus($l) {
        $data   = ['l'=>$l];
        if($l->status_id == 4) {
            $data['master_ship']  = MasterShipperModel::where('publish', 1)->get();
        }

        $view   = view('admin::transaction.widget.transaction_detail_status', $data)->render();

        return $view;
    }

    public function getShipManifest() {
        if(Request::has('header') && Request::has('detail')) {
            $headerID   = Request::get('header');
            $detailID   = Request::get('detail');
            $header = TransactionHeaderModel::find($headerID);
            if(!$header) {
                return $this->jsRespond(false, 'Oops. No Transaction header found. Please try again.');
            }
            $detail = TransactionDetailModel::where('transaction_header_id', $headerID)->find($detailID);
            if(!$detail) return $this->jsRespond(false, 'Oops. NO Transaction Found. Please try again.');

            $data   = [
                'customer'=>$detail->customer_name,
                'manifest'=>json_decode($detail->manifest_history)
            ];
            $view   = view('admin::transaction.widget.ship_manifest', $data)->render();

            return $this->jsRespond(true, 'Success', $view);
        }
        return $this->jsRespond('false', '');
    }

    public function revertTransactionDetailStatus() {
        if(!Request::has('id') || !Request::has('header')) {
            return $this->jsRespond(false, 'Oops. Illegal move');
        }
        $input  = Request::all();
        $id     = $input['id'];
        $header = $input['header'];

        $transaction    = TransactionDetailModel::where('transaction_header_id', $header)->find($id);
        if(!$transaction) {
            return $this->jsRespond(false,'Oops. No Transaction found, please try again.');
        }
        if($transaction->status_id <= 2 || ($transaction->status_id > 5 && $transaction->status_id <= 7)) {
            return $this->jsRespond(false, "Oops. The Transaction cannot be reverse anymore");
        }

        $admin  = Auth::guard('admin')->user();

        $newStatus  = 0;
        if($transaction->status_id == 3) {
            $newStatus  = 2;
        } else if($transaction->status_id == 4) {
            $newStatus  = 3;
        } else if($transaction->status_id == 5 || $transaction->status_id == 8) {
            $newStatus  = 4;
            $transaction->shipper_id    = 0;
            $transaction->tracking_code = '';
        }
        $transaction->status_id = $newStatus;
        $transaction->save();

        $log    = new TransactionDetailStatusLogModel;
        $log->transaction_detail_id = $transaction->id;
        $log->status_id             = $newStatus;
        $log->admin_id              = $admin->id;
        $log->save();

        $responseStatus = $this->prepareNextStatus($transaction);

        return $this->jsRespond(true, "Yeah", $responseStatus);
    }

    public function updateTransactionDetailQty() {
        if(Request::has('target') && Request::has('value') && Request::has('header')) {
            $input  = Request::all();
            $headerID   = $input['header'];
            $detailID   = $input['target'];
            $val        = intval($input['value']);



            $header = TransactionHeaderModel::find($headerID);
            if(!$header) return $this->jsRespond(false, "Oops.. No Transaction found. Please try again.");


            $detail = TransactionDetailModel::where('transaction_header_id', $headerID)->find($detailID);
            if(!$detail) return $this->jsRespond(false, "Oops. No Customer found. Please try again.");

            $allowedStatus   = [2,3,4,5,8];
            if(!in_array($detail->status_id, $allowedStatus)) return $this->jsRespond(false, "The transaction cannot be update anymore because of the transaction status");

            $detail->qty    = $val;
            $detail->save();

            $qtyLog = new TransactionDetailQtyLogModel;
            $qtyLog->transaction_detail_id  = $detail->id;
            $qtyLog->quantity   = $val;
            $qtyLog->admin_id   = Auth::guard('admin')->user()->id;
            $qtyLog->save();

            return $this->jsRespond(true, 'Success update Qty', ['value'=>$val]);
        }
        return $this->jsRespond(false, "oops. Illegal move.");
    }





































































    private function jsRespond($status, $message, $others=[]) {
        return response()->json(['status'=>$status, 'message'=>$message, 'others'=>$others]);
    }
}