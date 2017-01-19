<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    protected $table = 'exp_sequences';
    protected $fillable = [
		'meta_id',
		'library_num',
		'qubit',
		'index1',
		'index2',
		'fragment_size',
		'm_c',
		'sample_v',
		'water',
		'data',
		'ratio',
		'mix_v',
		'note'
    ];
    public function meta ()
    {
    	return $this->belongsTo('App\Models\SequenceMeta');
    }
}
