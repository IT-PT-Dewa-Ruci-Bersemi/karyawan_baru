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

    public function index()
    {
        $this->data['soals'] = SoalModel::where('grup_id',2)->where('publish', 1)->get();
        $this->data['grup'] = SoalGrupModel::where('publish', 1)->where('id',2)->first();
        return $this->render_view('soal.soal_identitas');
    }
}