<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DistributionMeta extends Model
{
    protected $table = 'exp_distribution_metas';
    protected $fillable = [
		'sample_source',
		'sample_plate_num',
		'serial_num',
		'pipeline',
		'operate_time',
		'lister',
		'sample_add_operator',
		'sample_add_auditor',
		'pcr_cycle',
		'combine_transfer_operator',
		'combine_transfer_autitor',
		'note',
		'elec_operator',
		'elec_name'
    ];
    public function distributions ()
    {
    	return $this->hasMany('App\Models\Distribution');
    }
}
