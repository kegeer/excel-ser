<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Sequence;
use App\Models\SequenceMeta;

class SequencesController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $sequences = Sequence::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($sequences);
		// return 'haha';
	}
    public function store (Request $request)
    {
        // dd($request->all());
    	$meta = [];
        $meta['operator'] = $request->get('operator');
        $meta['operate_time'] = $request->get('operate_time');
        $meta['run_regent'] = $request->get('run_regent');
        $meta['sample_sheet'] = $request->get('sample_sheet');
        $meta['phix_ratio'] = $request->get('phix_ratio');
        $meta['run_c'] = $request->get('run_c');
        $dm = SequenceMeta::create($meta);

        $sequences = $request->get('data');
        $created = [];
            if (!empty($sequence)) {
                foreach ($sequences as $sequence) {
                $data = [];
                $data['meta_id'] = $dm->id;
                $data['library_num'] = $sequence[1];
                $data['qubit'] = $sequence[2];
                $data['index1'] = $sequence[3];
                $data['index2'] = $sequence[4];
                $data['fragment_size'] = $sequence[5];
                $data['m_c'] = $sequence[6];
                $data['sample_v'] = $sequence[7];
                $data['water'] = $sequence[8];
                $data['data'] = $sequence[9];
                $data['ratio'] = $sequence[10];
                $data['mix_v'] = $sequence[11];
                $data['note'] = $sequence[12];
                $created = Sequence::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
