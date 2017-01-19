<?php

namespace App\Transformers;

use App\Models\Sample;
use League\Fractal\TransformerAbstract;

class SampleTransformer extends TransformerAbstract
{
	public function transform (Sample $sample)
	{
		return [
			'id' => $sample->id,
			'ori_num' => $sample->ori_num,
			'py_num' => $sample->py_num,
			'sample_type' => $sample->sample_type,
			'sample_amount' => $sample->sample_amount,
			'sender' => $sample->sender,
			'sender_contact' => $sample->sender_contact,
			'send_time' => $sample->send_time,
			'receive_status' => $sample->receive_status,
			'sample_status' => $sample->sample_status,
			'express_num' => $sample->express_num,
			'receive_time' => $sample->receive_time,
			'recipient' => $sample->recipient,
			'store_location' => $sample->store_location,
			'sample_batch' => $sample->sample_batch,
			'project' => $sample->project,
			'pipeline' => $sample->pipeline,
			'note' => $sample->note
		];
	}
}