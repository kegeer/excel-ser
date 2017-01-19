<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DilutionMeta extends Model
{
    protected $table = 'exp_dilution_metas';
    protected $fillable = ['operator', 'operate_time'];
    public function dilutions ()
    {
    	return $this->hasMany('App\Models\Dilution');
    }
}
