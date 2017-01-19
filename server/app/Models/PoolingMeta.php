<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoolingMeta extends Model
{
    protected $table = 'exp_pooling_metas';
    protected $fillable = [
		'sample_amount',
		'theoretic_c',
		'operator',
		'operate_time',
		'actual_c',
		'sample_v',
		'mb_v',
		'after_c_c'
    ];
    public function poolings ()
    {
    	return $this->hasMany('App\Models\Pooling');
    }
}
