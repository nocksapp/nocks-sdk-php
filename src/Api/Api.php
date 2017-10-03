<?php

namespace Nocks\SDK\Api;

use Nocks\SDK\Connection\RestClient;

/**
 * Class Api
 * @package Nocks\SDK\Api
 */
class Api
{
    /* @var \Nocks\SDK\Connection\RestClient $client */
    protected $client;

    /* @var $apiEndpoint */
    protected $apiEndpoint = "https://api.nocks.com/api/";

    public function __construct()
    {
        $this->client = new RestClient($this->apiEndpoint);
    }
}
