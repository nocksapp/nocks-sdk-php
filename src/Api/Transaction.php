<?php

namespace Nocks\SDK\Api;

/**
 * Class Transaction
 * @package Nocks\SDK\Api
 */
class Transaction extends Api
{
    /**
     * @param $transaction
     * @return \Nocks\SDK\Connection\Response
     */
    public function create($transaction)
    {
        $result = $this->client->post('transaction', null, $transaction);

        return json_decode($result->body(), true);
    }

    /**
     * @param $transactionId
     * @return \Nocks\SDK\Connection\Response
     */
    public function get($transactionId)
    {
        $result = $this->client->get('transaction/'.$transactionId);

        return json_decode($result->body(), true);
    }

    /**
     * @param $transactionId
     * @return \Nocks\SDK\Connection\Response
     */
    public function cancel($transactionId)
    {
        $result = $this->client->put('transaction/'.$transactionId, null, array('status' => 'cancelled'));

        return json_decode($result->body(), true);
    }
}