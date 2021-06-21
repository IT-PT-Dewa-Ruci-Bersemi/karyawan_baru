<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalModel;
use App\Modules\Admin\Models\NavigationModel;

class SoalController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:soal');
        parent::__construct();
        $this->set_page_title('Soal');
        $this->model    =  new SoalModel;
    }
    public function index()
    {
        $this->data['soal_grup']    = $this->_get_filter_select(new SoalGrupModel, 'grup');
        return $this->init('soal.soal_grid');
    }
}