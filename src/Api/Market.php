<?php

namespace Nocks\SDK\Api;

/**
 * Class Market
 * @package Nocks\SDK\Api
 */
class Market extends Api
{
    /**
     * @param $withdrawal
     * @param $deposit
     * @return \Nocks\SDK\Connection\Response
     */
    public function get($withdrawal, $deposit)
    {
        $result = $this->client->get('market', array('call' => $withdrawal, 'deposit' => $deposit));

        return json_decode($result->body(), true);
    }
}