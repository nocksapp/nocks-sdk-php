<?php

namespace Nocks\SDK;

use Nocks\SDK\Addon\Qr;
use Nocks\SDK\Addon\Rate;
use Nocks\SDK\Addon\ValidateAddress;
use Nocks\SDK\Api\Transaction;
use Nocks\SDK\Api\Price;

/**
 * Class Nocks
 * @package Nocks\SDK
 */
class Nocks
{
    /* @var Api\Transaction $transaction */
    protected $transaction;

    /* @var Api\Price $price */
    protected $price;

    /* @var Addon\Rate $price */
    protected $rate;

    /* @var Addon\Qr $qr */
    protected $qr;

    /* @var Addon\ValidateAddress $validateAddress */
    protected $validateAddress;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->price = new Price();
        $this->rate = new Rate();
        $this->qr = new Qr();
        $this->validateAddress = new ValidateAddress();
    }

    /**
     * Creates a transaction and returns transaction details
     *
     * @param $pair
     * @param $amount
     * @param $withdrawal
     * @param $returnUrl
     * @param $fee
     * @return Connection\Response
     */
    public function createTransaction($pair, $amount, $withdrawal, $returnUrl = '', $fee = 'deposit')
    {
        return $this->transaction->create(array(
            'pair' => $pair,
            'amount' => $amount,
            'withdrawal' => $withdrawal,
            'returnUrl' => $returnUrl,
            'fee' => $fee
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
     * Calculates the price for the transaction
     *
     * @param $pair
     * @param $amount
     * @param $fee
     * @return int
     */
    public function calculatePrice($pair, $amount, $fee = 'yes')
    {
        $price = $this->price->calculate(array(
            'pair' => $pair,
            'amount' => $amount,
            'fee' => $fee
        ));

        if(isset($price['success']) && isset($price['success']['amount']))
        {
            return $price['success']['amount'];
        }

        return 0;
    }

    /**
     * Get current price based on provided currency code
     *
     * @param $currencyCode
     * @return mixed
     */
    public function getCurrentRate($currencyCode)
    {
        return $this->rate->getCurrentRate($currencyCode);
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

    /**
     * Validates BTC and NLG addresses
     *
     * @param $currencyCode
     * @param $address
     * @return mixed
     */
    public function validateAddress($currencyCode, $address)
    {
        return $this->validateAddress->validate($currencyCode, $address);
    }
}