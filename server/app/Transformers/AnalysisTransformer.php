<?php

namespace App\Transformers;

use App\Models\Analysis;
use League\Fractal\TransformerAbstract;

class AnalysisTransformer extends TransformerAbstract
{
	public function transform (Analysis $analysis)
	{
		return [
			'id' => $analysis->id,
			'meta_id' => $analysis->meta_id,
			'py_num' => $analysis->py_num,
			'pipeline' => $analysis->pipeline,
			'primer' => $analysis->primer,
			'cycle' => $analysis->cycle,
			'c' => $analysis->c,
			'v' => $analysis->v,
			'elec_result' => $analysis->elec_result,
			'exp_batch' => $analysis->exp_batch,
			'project' => $analysis->project,
			'note' => $analysis->note
		];
	}
}