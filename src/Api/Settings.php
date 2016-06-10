<?php

namespace Nocks\SDK\Api;

/**
 * Class Settings
 * @package Nocks\SDK\Api
 */
class Settings extends Api
{
    /**
     * @return \Nocks\SDK\Connection\Response
     */
    public function get()
    {
        $transaction = $this->client->get('settings');

        return json_decode($transaction->body(), true);
    }
}