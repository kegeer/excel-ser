<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analysis extends Model
{
	protected $table = 'exp_analyses';
    protected $fillable = [
		'meta_id',
		'py_num',
		'pipeline',
		'primer',
		'cycle',
		'c',
		'v',
		'elec_result',
		'exp_batch',
		'project',
		'note'
    ];
    public function meta ()
    {
    	return $this->belongsTo('App\Models\AnalysisMeta');
    }
}
