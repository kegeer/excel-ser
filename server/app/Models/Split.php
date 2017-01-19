<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Split extends Model
{
    protected $table="exp_splits";
    protected $fillable = ['py_num', 'sample_type', 'sample_status', 'pipeline', 'm', 'v', 'left', 'exp_batch', 'project', 'note'];
    public function meta () 
    {
    	return $this->belongsTo('App\Models\SplitMeta');
    }
}
