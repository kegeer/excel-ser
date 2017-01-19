<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
 	protected $table = 'exp_distributions';
    protected $fillable = [
		'meta_id',
		'py_num',
		'position'
    ];
    public function meta ()
    {
    	return $this->belongsTo('App\Models\DistributionMeta');
    }
}
