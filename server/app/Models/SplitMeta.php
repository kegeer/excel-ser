<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SplitMeta extends Model
{
    protected $table = 'exp_split_metas';
    protected $fillable = ['operator', 'operate_time'];
    public function splits ()
    {
    	return $this->hasMany('App\Models\Split');
    }
}
