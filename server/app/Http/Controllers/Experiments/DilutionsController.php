<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Dilution;
use App\Models\DilutionMeta;

class DilutionsController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $dilutions = Dilution::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($dilutions);
	}
    public function store (Request $request)
    {
        // dd($request->all());
        $meta = [];
        $meta['operator'] = $request->get('operator');
        $meta['operate_time'] = $request->get('operate_time');
        $dm = DilutionMeta::create($meta);

        $dilutions = $request->get('data');
        $created = [];
        if (!empty($dilutions)) {
            foreach ($dilutions as $dilution) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['sample_id'] = $dilution[1];
                $data['pipeline'] = $dilution[2];
                $data['ori_c'] = $dilution[3];
                $data['sample_v'] = $dilution[4];
                $data['water'] = $dilution[5];
                $data['end_c'] = $dilution[6];
                $data['product_c'] = $dilution[7];
                $data['exp_bacth'] = $dilution[8];
                $data['project'] = $dilution[9];
                $data['note'] = $dilution[10];
                $created = Dilution::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
