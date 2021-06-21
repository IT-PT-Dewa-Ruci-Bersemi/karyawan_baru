<?php
namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Models\SoalGrupModel;

class SoalGrupController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:soal_grup');
        parent::__construct();
        $this->set_page_title('Grup Soal');
        $this->model    =  new SoalGrupModel;
    }
    public function index()
    {
        return $this->init('soal.soal_grid');
    }
}