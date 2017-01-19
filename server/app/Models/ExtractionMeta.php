<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExtractionMeta extends Model
{
    protected $table = 'exp_extraction_metas';
    protected $fillable = ['extract_operator', 'extract_time', 'purify_operator', 'purify_time'];
    public function extractions ()
    {
    	return $this->hasMany('App\Models\Extraction');
    }
}
