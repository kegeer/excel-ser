<?php

namespace App\Transformers;

use App\Models\Pooling;
use League\Fractal\TransformerAbstract;

class PoolingTransformer extends TransformerAbstract
{
	public function transform (Pooling $pooling)
	{
		return [
			'id' => $pooling->id,
			'meta_id' => $pooling->meta_id,
			'library_name' => $pooling->library_name,
			'py_num' => $pooling->py_num,
			'primer' => $pooling->primer,
			'c' => $pooling->c,
			'cycle' => $pooling->cycle,
			'sample_v' => $pooling->sample_v,
			'sample_m' => $pooling->sample_m,
			'exp_batch' => $pooling->exp_batch,
			'note' => $pooling->note
		];
	}
}