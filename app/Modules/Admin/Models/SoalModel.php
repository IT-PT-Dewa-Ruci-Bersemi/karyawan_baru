<?php
namespace App\Modules\Admin\Models;

class SoalModel extends CoreGenesisModel {
    protected $table    = 'soal';
    protected $with     = ['soal_grup'];

    public function soal_grup()
    {
        return $this->belongsTo(SoalGrupModel::class,'grup_id','id');
    }

    public function soal_jawaban()
    {
        return $this->hasMany(SoalJawabanModel::class,'id','soal_id');
    }

}