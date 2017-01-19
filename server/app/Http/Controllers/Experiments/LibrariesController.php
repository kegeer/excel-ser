<?php

namespace App\Http\Controllers\Experiments;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Library;
class LibrariesController extends ApiController
{
    public function index ()
	{
		$sort = $this->parameters->sort();
        $order = $this->parameters->order();
        $limit = $this->parameters->limit();

        $libraries = Library::orderBy($sort, $order)->paginate($limit);
		return $this->response->collection($libraries);
		// return 'haha';
	}
    public function store (Request $request)
    {
        $libraries = $request->get('data');
        $created = [];
            if (!empty($library)) {
                foreach ($libraries as $library) {
                $data = [];
                $data['name'] = $library[1];
                $data['method'] = $library[2];
                $data['operator'] = $library[3];
                $data['operate_time'] = $library[4];
                $data['project'] = $library[5];
                $data['pre_v'] = $library[6];
                $data['pre_c'] = $library[7];
                $data['after_index'] = $library[8];
                $data['after_v'] = $library[9];
                $data['after_c'] = $library[10];
                $data['after_elec'] = $library[11];
                $data['after_size'] = $library[12];
                $data['note'] = $library[13];
                $created = Library::create($data);
            }
        }
        
        return $this->response->json($created);
    }
}
