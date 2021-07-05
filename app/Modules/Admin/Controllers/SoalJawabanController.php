<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalGrupModel;
use App\Modules\Admin\Models\SoalModel;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Models\VwGrupSoalJawabanModel;
use Illuminate\Support\Facades\Request;

class SoalJawabanController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:cek');
        parent::__construct();
        $this->model    =  new SoalModel;
    }

    public function detail($id)
    {
        $this->data['soals'] = SoalModel::where('grup_id',$id)->where('publish', 1)->get();
        $this->data['grup'] = SoalGrupModel::where('publish', 1)->where('id',$id)->first();
        return $this->render_view('soal.soal_identitas');
    }

    public function move()
    {
        $request = Request::all();
        dd($request->input('action'));
        
    }

    public function index()
    {
        
        $this->model = new VwGrupSoalJawabanModel();
        return $this->init('soal.vw_grup_soal_jawaban');
    }
}