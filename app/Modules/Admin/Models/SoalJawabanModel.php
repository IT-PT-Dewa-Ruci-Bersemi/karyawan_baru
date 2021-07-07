<?php
namespace App\Modules\Admin\Models;

class SoalJawabanModel extends CoreGenesisModel{
    protected $table = 'soal_jawaban';
    protected $fillable = ['user_id','soal_id','jawaban'];
}