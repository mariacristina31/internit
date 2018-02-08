<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
     */

    'supportsCredentials' => false,
    'allowedOrigins' => ['*'],
    'allowedOriginsPatterns' => [],
    'allowedHeaders' => ['POST, GET, OPTIONS, PUT, DELETE'],
    'allowedMethods' => ['*'],
    'exposedHeaders' => ['Content-Type, Accept, Authorization, X-Requested-With, Application'],
    'maxAge' => 0,

];
