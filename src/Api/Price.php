<?php

namespace Nocks\SDK\Api;

/**
 * Class Price
 * @package Nocks\SDK\Api
 */
class Price extends Api
{
    /**
     * @param $price
     * @return \Nocks\SDK\Connection\Response
     */
    public function calculate($price)
    {
        $result = $this->client->post('price', null, $price);

        return json_decode($result->body(), true);
    }
}