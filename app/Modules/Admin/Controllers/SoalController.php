<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalModel;
use App\Modules\Admin\Models\SoalGrupModel;

class SoalController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:list_soal');
        parent::__construct();
        $this->set_page_title('Soal');
        $this->model    =  new SoalModel;
    }
    public function index()
    {
        $this->data['soal_grup']    = $this->_get_filter_select(SoalGrupModel::where('publish', 1), 'grup');
        return $this->init('soal.soal_grid');
    }
}