<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalGrupModel;
use App\Modules\Admin\Models\SoalModel;

class SoalJawabanController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:cek');
        parent::__construct();
        $this->model    =  new SoalModel;
    }

    public function index($id)
    {
        if ($id=null) {
            $id = 2;
        }
        $this->data['soals'] = SoalModel::where('grup_id',$id)->where('publish', 1)->get();
        $this->data['grup'] = SoalGrupModel::where('publish', 1)->where('id',$id)->first();
        return $this->render_view('soal.soal_identitas');
    }

    public function move(Request $request)
    {
        switch ($request->input('action')) {
            case 'save':
                $this->index($request->input('grup')-1);
                break;
            
            case 'back':
                $this->index($request->input('grup')+1);
                break;
        }
    }
}