<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalGrupModel;
use App\Modules\Admin\Models\SoalModel;
use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Models\VwGrupSoalJawabanModel;
use Illuminate\Support\Facades\Request;
use App\Modules\Admin\Models\SoalJawabanModel;

class SoalJawabanController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:cek');
        parent::__construct();
        $this->model    =  new SoalModel;
    }

    public function detail($id)
    {
        
        $this->data['grup'] = SoalGrupModel::where('publish', 1)->where('id',$id)->first();
        $this->data['soals'] = SoalModel::where('grup_id',$id)->where('publish', 1)->get();
        return $this->render_view('soal.soal_identitas');
    }

    public function move()
    {
        $request = Request::all();
        $id = $request['id'];
        $jawaban = $request['jawaban'];
        $user = Auth::guard('admin')->user()->id;
        for ($i=0; $i < count($id); $i++) { 
            $data = array(
                'user_id' => $user,  
                'soal_id' => $id[$i],
            );
            $jwb = array(
                'jawaban' => $jawaban[$i],
            );
            SoalJawabanModel::updateOrCreate($data,$jwb);
        }
        
        if ($request['action']=='save') {
            return redirect()->route('cekaja', ['id' => $request['grup_id']+1]);
        } else {
            return redirect()->route('cekaja', ['id' => $request['grup_id']-s1]);
        }
        
    }

    public function index()
    {
        
        $this->model = new VwGrupSoalJawabanModel();
        return $this->init('soal.vw_grup_soal_jawaban');
    }
}