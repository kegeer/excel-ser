<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Split;
use App\Models\SplitMeta;

class SplitsController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $splits = Split::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($splits);
		// return 'haha';
	}
    public function store (Request $request)
    {
        // dd($request->all());
    	$meta = [];
        $meta['operator'] = $request->get('operator');
        $meta['operate_time'] = $request->get('operate_time');
        $dm = SplitMeta::create($meta);

        $splits = $request->get('data');
        $created = [];
        if (!empty($splits)) {
            foreach ($splits as $split) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['py_num'] = $split[1];
                $data['sample_type'] = $split[2];
                $data['sample_status'] = $split[3];
                $data['pipeline'] = $split[4];
                $data['m'] = $split[5];
                $data['v'] = $split[6];
                $data['left'] = $split[7];
                $data['exp_batch'] = $split[8];
                $data['project'] = $split[9];
                $data['note'] = $split[10];
                $created = Split::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
