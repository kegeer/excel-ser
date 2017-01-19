<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Data Serializer
    |--------------------------------------------------------------------------
    |
    | Here you may choose the default data serializer to be used as the API
    | output format, serializers let you switch between various output formats
    | with minimal effect on your transformers.
    |
    | Supported: DataArraySerializer, ArraySerializer and JsonApiSerializer
    |
    | You can also create your own serializer, see more at the link below:
    | http://fractal.thephpleague.com/serializers
    |
    */

    'serializer' => League\Fractal\Serializer\DataArraySerializer::class,

    /*
    |--------------------------------------------------------------------------
    | Default transformers
    |--------------------------------------------------------------------------
    |
    | Here you may register default transformers, this transformers will be
    | used when you try to transform an eloquent model without specifying a
    | transformer, feel free to register as many as you need.
    |
    */

    'transformers' => [
        App\User::class => App\Transformers\UserTransformer::class,
        App\Models\Sample::class => App\Transformers\SampleTransformer::class,
        App\Models\Dilution::class => App\Transformers\DilutionTransformer::class,
        App\Models\Split::class => App\Transformers\SplitTransformer::class,
        App\Models\Extraction::class => App\Transformers\ExtractionTransformer::class,
        App\Models\Analysis::class => App\Transformers\AnalysisTransformer::class,
        App\Models\Distribution::class => App\Transformers\DistributionTransformer::class,
        App\Models\Library::class => App\Transformers\LibraryTransformer::class,
    ],
];
