<?php
namespace App\Modules\Admin\Controllers;

class KaryawanBaruController extends GenesisController {
    public function __construct()
    {
        $this->middleware('admin_role:pekerjaan');
        parent::__construct();
        $this->set_page_tittle('Pekerjaan yang diinginkan');

    }

    
}