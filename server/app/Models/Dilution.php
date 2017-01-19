<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dilution extends Model
{
	protected $table = 'exp_dilutions';
    protected $fillable = ['sample_id', 'pipeline', 'ori_c', 'sample_v', 'water', 'end_c', 'product_c', 'exp_bacth', 'project', 'note'];
    public function meta () {
    	return $this->belongsTo('App\Models\DilutionMeta');
    }
}
