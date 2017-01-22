<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Distribution;
use App\Models\DistributionMeta;

class DistributionsController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit(96);

        $distributions = Distribution::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($distributions);
		// return 'haha';
	}
    public function store (Request $request)
    {
        // dd($request->all());
    	$meta = [];
        $meta['sample_source'] = $request->get('sample_source');
        $meta['sample_plate_num'] = $request->get('sample_plate_num');
        $meta['serial_num'] = $request->get('serial_num');
        $meta['pipeline'] = $request->get('pipeline');
        $meta['operate_time'] = $request->get('operate_time');
        $meta['lister'] = $request->get('lister');
        $meta['sample_add_operator'] = $request->get('sample_add_operator');
        $meta['sample_add_auditor'] = $request->get('sample_add_auditor');
        $meta['pcr_cycle'] = $request->get('pcr_cycle');
        $meta['combine_transfer_operator'] = $request->get('combine_transfer_operator');
        $meta['combine_transfer_autitor'] = $request->get('combine_transfer_autitor');
        $meta['note'] = $request->get('note');
        $meta['elec_operator'] = $request->get('elec_operator');
        $meta['elec_name'] = $request->get('elec_name');
        $dm = DistributionMeta::create($meta);

        $distributions = $request->get('data');
        $data = array_flatten($distributions);
        $created = [];
        foreach ($data as $key => $value) {
            if ($value) {
                $created = Distribution::create([
                    'meta_id' => $dm->id,
                    'py_num' => $value,
                    'position' => $key + 1
                ]);
            }
        }

        return $this->response->json($created);
    }
}
