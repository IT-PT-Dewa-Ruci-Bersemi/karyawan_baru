<?php
namespace App\Modules\Admin\Models;

class SoalJawabanModel extends CoreGenesisModel{
    protected $table = 'soal_jawaban';
    protected $fillable = ['soal_id','jawaban'];
}