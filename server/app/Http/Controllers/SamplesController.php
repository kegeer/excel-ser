<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sample;

class SamplesController extends ApiController
{
	public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $samples = Sample::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($samples);
		// return 'haha';
	}
    public function store (Request $request)
    {
    	// dd($request->all());
        $samples = $request->except('_url');
        $created = [];
        foreach ($samples as $sample) {
        	$data = [];
            $data['ori_num'] = $sample[1];
            $data['py_num'] = $sample[2];
            $data['sample_type'] = $sample[3];
            $data['sample_amount'] = $sample[4];
            $data['sender'] = $sample[5];
            $data['sender_contact'] = $sample[6];
            $data['send_time'] = $sample[7];
            $data['receive_status'] = $sample[8];
            $data['sample_status'] = $sample[9];
            $data['express_num'] = $sample[10];
            $data['receive_time'] = $sample[11];
            $data['recipient'] = $sample[12];
            $data['store_location'] = $sample[13];
            $data['sample_batch'] = $sample[14];
            $data['project'] = $sample[15];
            $data['pipeline'] = $sample[16];
            $data['note'] = $sample[17];
            $created = Sample::create($data);
        }
        return $this->response->json($created);
    }
}
