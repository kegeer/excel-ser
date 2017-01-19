<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['api']], function () {
	Route::resource('samples', 'SamplesController');
	Route::resource('dilutions', 'Experiments\DilutionsController');
	Route::resource('splits', 'Experiments\SplitsController');
	Route::resource('extractions', 'Experiments\ExtractionsController');
	Route::resource('analyses', 'Experiments\AnalysesController');
	Route::resource('distributions', 'Experiments\DistributionsController');
	Route::resource('libraries', 'Experiments\LibrariesController');
	Route::resource('poolings', 'Experiments\PoolingsController');
	Route::resource('sequences', 'Experiments\SequencesController');
});