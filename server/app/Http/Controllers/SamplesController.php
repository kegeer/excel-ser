<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sample;
use App\Transformers\SampleTransformer;

class SamplesController extends ApiController
{
	public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $samples = Sample::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($samples, new SampleTransformer);
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
    public function show ($id)
    {
        $sample = $this->findOrNot($id);
        return $this->response->item($sample, new SampleTransformer);
    }
    public function simple (Request $request)
    {
        $res = [];
        $samples = $request->all();
        foreach ($samples as $sample) {
            $res = Sample::create([
                'ori_num' => $sample['ori_num'],
                'py_num' => $sample['py_num'],
                'sample_type' => $sample['sample_type'],
                'sample_amount' => $sample['sample_amount'],
                'sender' => $sample['sender'],
                'sender_contact' => $sample['sender_contact'],
                'send_time' => $sample['send_time'],
                'receive_status' => $sample['receive_status'],
                'sample_status' => $sample['sample_status'],
                'express_num' => $sample['express_num'],
                'receive_time' => $sample['receive_time'],
                'recipient' => $sample['recipient'],
                'store_location' => $sample['store_location'],
                'sample_batch' => $sample['sample_batch'],
                'project' => $sample['project'],
                'pipeline' => $sample['pipeline'],
                'note' => $sample['note']
            ]);
        }
        return $this->response->withCreated($res, new SampleTransformer);
    }
    public function update (request $request, $id)
    {
        $sample = $this->findOrNot($id);
        $sample->fill([
            'ori_num' => $request->get('ori_num'),
            'py_num' => $request->get('py_num'),
            'sample_type' => $request->get('sample_type'),
            'sample_amount' => $request->get('sample_amount'),
            'sender' => $request->get('sender'),
            'sender_contact' => $request->get('sender_contact'),
            'send_time' => $request->get('send_time'),
            'receive_status' => $request->get('receive_status'),
            'sample_status' => $request->get('sample_status'),
            'express_num' => $request->get('express_num'),
            'receive_time' => $request->get('receive_time'),
            'recipient' => $request->get('recipient'),
            'store_location' => $request->get('store_location'),
            'sample_batch' => $request->get('sample_batch'),
            'project' => $request->get('project'),
            'pipeline' => $request->get('pipeline'),
            'note' => $request->get('note')
        ])->save();
        return $this->response->item($sample, new SampleTransformer);
    }
    public function destroy ($id)
    {
        $sample = $this->findOrNot($id);
        $sample->delete();
        return $this->response->withNoContent();
    }
    protected function findOrNot($id)
    {
        $sample = Sample::find($id);
        if (!$sample) {
            return $this->response->withNotFound('Sample not found');
        }
        return $sample;
    }
}
