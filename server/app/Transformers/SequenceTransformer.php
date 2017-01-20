<?php

namespace App\Transformers;

use App\Models\Sequence;
use League\Fractal\TransformerAbstract;

class SequenceTransformer extends TransformerAbstract
{
	public function transform (Sequence $sequence)
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