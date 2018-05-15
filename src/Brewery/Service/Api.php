<?php

namespace Brewery\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Api
{
  /**
  * @var Array
  */
  private $config;

  /**
   * @var GuzzleHttp\Client
   */
  private $client;

  public function __construct(Array $config)
  {
      $this->config = $config;
      
      $this->client = new Client([
        'base_uri' => $this->config['brewery']['api']['uri'],
        'timeout' => $this->config['brewery']['api']['timeout']
      ]);
  }
  
  public function send($verb, $route, $params = [], $headers = [])
  {
      try {
          $options = [
            'debug' => false,
            'http_errors' => false
          ];
          
          if ((is_array($headers)) && (! empty($headers))) {
            $options['headers'] = $headers;
          }
          
          $secret = $this->config['brewery']['api']['key'];
          
          $version = $this->config['brewery']['api']['version']; 
           
          $options['query'] =  array_merge($params, ['key' => $secret]);
          
          $response = $this->client->request($verb, $version . $route, $options);

          $body = $response->getBody();

          return json_decode($body->getContents());
      } catch(RequestException $e) {
          $response = $e->getResponse();
          return $response->getBody()->getContents();
      }
  }
}
