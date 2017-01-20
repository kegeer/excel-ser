<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Pooling;
use App\Models\PoolingMeta;

class PoolingsController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $poolings = Pooling::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($poolings);
		// return 'haha';
	}
    public function store (Request $request)
    {
        // dd($request->all());
    	$meta = [];
        $meta['sample_amount'] = $request->get('sample_amount');
        $meta['theoretic_c'] = $request->get('theoretic_c');
        $meta['operator'] = $request->get('operator');
        $meta['operate_time'] = $request->get('operate_time');
        $meta['actual_c'] = $request->get('actual_c');
        $meta['sample_v'] = $request->get('sample_v');
        $meta['mb_v'] = $request->get('mb_v');
        $meta['after_c_c'] = $request->get('after_c_c');
        $dm = PoolingMeta::create($meta);

        $poolings = $request->get('data');
        $created = [];
            if (!empty($poolings)) {
                foreach ($poolings as $pooling) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['library_name'] = $pooling[1];
                $data['py_num'] = $pooling[2];
                $data['primer'] = $pooling[3];
                $data['c'] = $pooling[4];
                $data['cycle'] = $pooling[5];
                $data['sample_v'] = $pooling[6];
                $data['sample_m'] = $pooling[7];
                $data['exp_batch'] = $pooling[8];
                $data['note'] = $pooling[9];
        
                $created = Pooling::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
