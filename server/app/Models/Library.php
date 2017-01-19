<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table = 'exp_libraries';
    protected $fillable = [
		'name',
		'method',
		'operator',
		'operate_time',
		'project',
		'pre_v',
		'pre_c',
		'after_index',
		'after_v',
		'after_c',
		'after_elec',
		'after_size',
		'note'
    ];
}
