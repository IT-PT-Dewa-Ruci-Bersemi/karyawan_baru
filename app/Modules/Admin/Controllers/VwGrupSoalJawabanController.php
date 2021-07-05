<?php
namespace App\Modules\Admin\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Modules\Admin\Models\VwGrupSoalJawabanModel;

class VwGrupSoalJawabanController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:cek');
        parent::__construct();
        $this->model = new VwGrupSoalJawabanModel();
    }

    public function index()
    {
        return $this->init('soal.vw_grup_soal_jawaban');
    }
}