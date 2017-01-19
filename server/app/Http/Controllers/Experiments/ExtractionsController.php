<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Extraction;
use App\Models\ExtractionMeta;

class ExtractionsController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $extractions = Extraction::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($extractions);
		// return 'haha';
	}
    public function store (Request $request)
    {
    	$meta = [];
        $meta['extract_operator'] = $request->get('extract_operator');
        $meta['extract_time'] = $request->get('extract_time');
        $meta['purify_operator'] = $request->get('purify_operator');
        $meta['purify_time'] = $request->get('purify_time');
        $dm = ExtractionMeta::create($meta);
        $extractions = $request->get('data');
        $created = [];
        if (!empty($extractions)) {
            foreach ($extractions as $extraction) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['py_num'] = $extraction[1];
                $data['sample_type'] = $extraction[2];
                $data['pipeline'] = $extraction[3];
                $data['c'] = $extraction[4];
                $data['v'] = $extraction[5];
                $data['total'] = $extraction[6];
                $data['elec_result'] = $extraction[7];
                $data['exp_batch'] = $extraction[8];
                $data['project'] = $extraction[9];
                $data['note'] = $extraction[10];
                $created = Extraction::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
