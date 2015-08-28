<?php

namespace Nocks\SDK\Addon;
use GuzzleHttp\Client;

/**
 * Class Price
 * @package Nocks\SDK\Addon
 */
class Price
{
    public function __construct()
    {
        $this->client = new Client();
    }

    function getCurrentPrice($currencyCode)
    {
        $price = 0;

        if(in_array($currencyCode, array('USD', 'GBP', 'EUR')))
        {
            // Powered by CoinDesk
            $response = $this->client->get('https://api.coindesk.com/v1/bpi/currentprice.json');
            $response = json_decode($response->getBody()->getContents(), true);

            if(isset($response['bpi'][$currencyCode]['rate']))
            {
                $price = $response['bpi'][$currencyCode]['rate'];
            }
        }
        elseif(in_array($currencyCode, array('BTC', 'NLG')))
        {
            // Powered by Bittrex
            $response = $this->client->get('https://bittrex.com/api/v1.1/public/getticker?market=BTC-NLG');
            $response = json_decode($response->getBody()->getContents(), true);

            if(isset($response['result']['Last']))
            {
                $price = $response['result']['Last'];
            }
        }

        return $price;
    }
}