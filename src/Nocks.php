<?php

namespace Nocks\SDK;

use Nocks\SDK\Addon\Price;
use Nocks\SDK\Api\Transaction;

/**
 * Class Nocks
 * @package Nocks\SDK
 */
class Nocks
{
    /* @var Api\Transaction $transaction */
    protected $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->price = new Price();
    }

    /**
     * @param $pair
     * @param $amount
     * @param $withdrawal
     * @param $returnUrl
     * @return Connection\Response
     */
    public function createTransaction($pair, $amount, $withdrawal, $returnUrl = '')
    {
        return $this->transaction->create(array(
            'pair' => $pair,
            'amount' => $amount,
            'withdrawal' => $withdrawal,
            'returnUrl' => $returnUrl
        ));
    }

    /**
     * @param $transactionId
     * @return Connection\Response
     */
    public function getTransaction($transactionId)
    {
        return $this->transaction->get($transactionId);
    }

    /**
     * @param $currencyCode
     * @return mixed
     */
    public function getCurrentPrice($currencyCode)
    {
        return $this->price->getCurrentPrice($currencyCode);
    }
}