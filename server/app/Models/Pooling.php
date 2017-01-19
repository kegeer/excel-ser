<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pooling extends Model
{
    protected $table = 'exp_poolings';
    protected $fillable = [
		'meta_id',
		'library_name',
		'py_num',
		'primer',
		'c',
		'cycle',
		'sample_v',
		'sample_m',
		'exp_batch',
		'note'
    ];
    public function meta ()
    {
    	return $this->belongsTo('App\Models\PoolingMeta');
    }
}
