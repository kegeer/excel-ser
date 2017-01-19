<?php

namespace App\Transformers;

use App\Models\Library;
use League\Fractal\TransformerAbstract;

class LibraryTransformer extends TransformerAbstract
{
	public function transform (Library $library)
	{
		return [
			'id' => $library->id,
			'name' => $library->name,
			'method' => $library->method,
			'operator' => $library->operator,
			'operate_time' => $library->operate_time,
			'project' => $library->project,
			'pre_v' => $library->pre_v,
			'pre_c' => $library->pre_c,
			'after_index' => $library->after_index,
			'after_v' => $library->after_v,
			'after_c' => $library->after_c,
			'after_elec' => $library->after_elec,
			'after_size' => $library->after_size,
			'note' => $library->note
		];
	}
}