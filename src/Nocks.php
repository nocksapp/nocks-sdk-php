<?php

namespace Nocks\SDK;

use Nocks\SDK\Addon\Qr;
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

    /* @var Addon\Price $price */
    protected $price;

    /* @var Addon\Qr $qr */
    protected $qr;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->price = new Price();
        $this->qr = new Qr();
    }

    /**
     * Creates a transaction and returns transaction details
     *
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
     * Get transaction details
     *
     * @param $transactionId
     * @return Connection\Response
     */
    public function getTransaction($transactionId)
    {
        return $this->transaction->get($transactionId);
    }

    /**
     * Get current price based on provided curreny code
     *
     * @param $currencyCode
     * @return mixed
     */
    public function getCurrentPrice($currencyCode)
    {
        return $this->price->getCurrentPrice($currencyCode);
    }

    /**
     * Render QR Code
     *
     * @param $text
     * @param int $size
     * @return string
     */
    public function renderQrCode($text, $size = 200)
    {
        return $this->qr->render($text, $size);
    }
}