<?php

namespace App\Transformers;

use App\Models\Dilution;
use League\Fractal\TransformerAbstract;

class DilutionTransformer extends TransformerAbstract
{
	public function transform (Dilution $dilution)
	{
		return [
			'id' => $dilution->id,
			'meta_id' => $dilution->meta_id,
			'sample_id' => $dilution->sample_id,
			'pipeline' => $dilution->pipeline,
			'ori_c' => $dilution->ori_c,
			'sample_v' => $dilution->sample_v,
			'water' => $dilution->water,
			'end_c' => $dilution->end_c,
			'product_c' => $dilution->product_c,
			'exp_bacth' => $dilution->exp_bacth,
			'project' => $dilution->project,
			'note' => $dilution->note
		];
	}
}