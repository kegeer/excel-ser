<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extraction extends Model
{
    protected $table="exp_extractions";
    protected $fillable = ['meta_id', 'py_num', 'sample_type', 'pipeline', 'c', 'v', 'total', 'elec_result', 'exp_batch', 'project', 'note'];
    public function meta () {
    	return $this->belongsTo('App\Models\ExractionMeta');
    }
}
