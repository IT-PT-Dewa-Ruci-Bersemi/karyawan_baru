<?php
namespace App\Modules\Admin\Models;

class SoalModel extends CoreGenesisModel {
    protected $table    = 'soal';
    protected $with     = ['soal_grup'];

    public function soal_grup()
    {
        return $this->hasOne(SoalGrupModel::class,'id','grup_id');
    }
}