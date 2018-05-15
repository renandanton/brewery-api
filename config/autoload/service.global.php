<?php

return [
    'dependencies' => [
        'invokables' => [
          App\Service\CorsService::class => App\Service\CorsService::class,  
          App\Validation\SearchValidation::class => App\Validation\SearchValidation::class
        ],  
        'factories' => [
            App\Action\HomePageAction::class => App\Factory\HomePageFactory::class,
            App\Action\RandomAction::class => App\Factory\RandomFactory::class,
            App\Action\SearchAction::class => App\Factory\SearchFactory::class,
            
            Brewery\Service\Api::class => Brewery\Factory\BreweryFactory::class,
        ],
    ],
];
