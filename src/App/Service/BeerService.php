<?php 

namespace App\Service;

use Brewery\Service\Api as BreweryApi;

class BeerService
{
    protected $api;

    public function __construct(BreweryApi $brewery)
    {
        $this->api = $brewery;
    }
    
    public function random()
    {
       $response = $this->api->send('GET', '/beer/random', [
         'hasLabels' => 'y',
         'withBreweries'=> 'y'
       ], []);
       
       return $response;
    }
  
    public function search($params=[])
    {
       $response = $this->api->send('GET', '/search', $params, []);
       return $response;
    }
}