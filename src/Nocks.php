<?php

namespace Nocks\SDK;

use Nocks\SDK\Addon\Qr;
use Nocks\SDK\Addon\Rate;
use Nocks\SDK\Addon\ValidateAddress;
use Nocks\SDK\Api\Settings;
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

    /* @var Api\Settings $settings */
    protected $settings;

    /* @var Addon\Qr $qr */
    protected $qr;

    /* @var Addon\ValidateAddress $validateAddress */
    protected $validateAddress;

    public function __construct()
    {
        $this->transaction = new Transaction();
        $this->price = new Price();
        $this->rate = new Rate();
        $this->settings = new Settings();
        $this->qr = new Qr();
        $this->validateAddress = new ValidateAddress();
    }

    /**
     * Creates a transaction and returns transaction details
     *
     * @param $pair
     * @param $amount
     * @param $withdrawal
     * @param $options
     * @return Connection\Response
     */
    public function createTransaction($pair, $amount, $withdrawal, $options = array())
    {
        $transaction = array(
            'pair' => $pair,
            'amount' => $amount,
            'withdrawal' => $withdrawal,
        );

        $data = array_merge($transaction, $options);

        return $this->transaction->create($data);
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
     * Cancel transaction
     *
     * @param $transactionId
     * @return Connection\Response
     */
    public function cancelTransaction($transactionId)
    {
        return $this->transaction->cancel($transactionId);
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

    /**
     * Get list of all available payment methods
     *
     * @return mixed
     */
    public function listPaymentMethods()
    {
        $settings = $this->settings->get();

        if(isset($settings['paymentMethods']))
        {
            return $settings['paymentMethods'];
        }

        return array();
    }

    /**
     * Get list of all available banks
     *
     * @return mixed
     */
    public function listBanks()
    {
        $settings = $this->settings->get();

        if(isset($settings['banks']))
        {
            return $settings['banks'];
        }

        return array();
    }
}