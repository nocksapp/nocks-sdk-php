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
        $transaction = $this->client->post('transaction', null, $transaction);

        return json_decode($transaction->body(), true);
    }

    /**
     * @param $transactionId
     * @return \Nocks\SDK\Connection\Response
     */
    public function get($transactionId)
    {
        $transaction = $this->client->get('transaction/'.$transactionId);

        return json_decode($transaction->body(), true);
    }
}