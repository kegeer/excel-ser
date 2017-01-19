<?php

namespace App\Transformers;

use App\Models\Extraction;
use League\Fractal\TransformerAbstract;

class ExtractionTransformer extends TransformerAbstract
{
	public function transform (Extraction $extraction)
	{
		return [
			'id' => $extraction->id,
			'meta_id' => $extraction->meta_id,
			'py_num' => $extraction->py_num,
			'sample_type' => $extraction->sample_type,
			'pipeline' => $extraction->pipeline,
			'c' => $extraction->c,
			'v' => $extraction->v,
			'total' => $extraction->total,
			'elec_result' => $extraction->elec_result,
			'exp_batch' => $extraction->exp_batch,
			'project' => $extraction->project,
			'note' => $extraction->note
		];
	}
}