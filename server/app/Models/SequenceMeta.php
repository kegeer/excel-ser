<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SequenceMeta extends Model
{
    protected $table = 'exp_sequence_metas';
    protected $fillable = [
		'operator',
		'operate_time',
		'run_regent',
		'sample_sheet',
		'phix_ratio',
		'run_c'
   	];
    public function sequences ()
    {
    	return $this->hasMany('App\Models\Sequence');
    }
}
