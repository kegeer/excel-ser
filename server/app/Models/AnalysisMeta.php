<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnalysisMeta extends Model
{
    protected $table = 'exp_analysis_metas';
    protected $fillable = ['purify_operator', 'operate_time'];
    public function analyses ()
    {
    	return $this->hasMany('App\Models\Analysis');
    }
}
