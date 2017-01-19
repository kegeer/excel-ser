<?php

namespace App\Transformers;

use App\Models\Distribution;
use League\Fractal\TransformerAbstract;

class DistributionTransformer extends TransformerAbstract
{
	public function transform (Distribution $distribution)
	{
		return [
			'id' => $distribution->id,
			'meta_id' => $distribution->meta_id,
			'py_num' => $distribution->py_num,
			'position' => $distribution->position
		];
	}
}