<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Analysis;
use App\Models\AnalysisMeta;

class AnalysesController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $analyses = Analysis::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($analyses);
		// return 'haha';
	}
    public function store (Request $request)
    {
        // dd($request->all());
    	$meta = [];
        $meta['purify_operator'] = $request->get('purify_operator');
        $meta['operate_time'] = $request->get('operate_time');
        $dm = AnalysisMeta::create($meta);

        $analyses = $request->get('data');
        $created = [];
        if (!empty($analyses)) {
            foreach ($analyses as $analysis) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['py_num'] = $analysis[1];
                $data['pipeline'] = $analysis[2];
                $data['primer'] = $analysis[3];
                $data['cycle'] = $analysis[4];
                $data['c'] = $analysis[5];
                $data['v'] = $analysis[6];
                $data['elec_result'] = $analysis[7];
                $data['exp_batch'] = $analysis[8];
                $data['project'] = $analysis[9];
                $data['note'] = $analysis[10];
                $created = Analysis::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
