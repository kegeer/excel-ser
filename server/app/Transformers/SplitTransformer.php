<?php

namespace App\Transformers;

use App\Models\Split;
use League\Fractal\TransformerAbstract;

class SplitTransformer extends TransformerAbstract
{
	public function transform (Split $split)
	{
		return [
			'id' => $split->id,
			'meta_id' => $split->meta_id,
			'py_num' => $split->py_num,
			'sample_type' => $split->sample_type,
			'sample_status' => $split->sample_status,
			'pipeline' => $split->pipeline,
			'm' => $split->m,
			'v' => $split->v,
			'left' => $split->left,
			'exp_batch' => $split->exp_batch,
			'project' => $split->project,
			'note' => $split->note
		];
	}
}