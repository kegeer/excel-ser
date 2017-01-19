<?php

namespace App\Transformers;

use App\Models\Sequencec;
use League\Fractal\TransformerAbstract;

class SequencecTransformer extends TransformerAbstract
{
	public function transform (Sequencec $sequence)
	{
		return [
			'id' => $sequence->id,
			'meta_id' => $sequence->meta_id,
			'library_num' => $sequence->library_num,
			'qubit' => $sequence->qubit,
			'index1' => $sequence->index1,
			'index2' => $sequence->index2,
			'fragment_size' => $sequence->fragment_size,
			'm_c' => $sequence->m_c,
			'sample_v' => $sequence->sample_v,
			'water' => $sequence->water,
			'data' => $sequence->data,
			'ratio' => $sequence->ratio,
			'mix_v' => $sequence->mix_v,
			'note' => $sequence->note
		];
	}
}