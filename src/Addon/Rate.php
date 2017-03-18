<?php

namespace Nocks\SDK\Addon;

use GuzzleHttp\Client;

/**
 * Class Rate
 * @package Nocks\SDK\Addon
 */
class Rate
{
    public function __construct()
    {
        $this->client = new Client();
    }

    function getCurrentRate($currencyCode)
    {
        $rate = 0;

        if(in_array($currencyCode, array('USD', 'GBP', 'EUR')))
        {
            // Powered by CoinDesk
            $response = $this->client->get('http://api.coindesk.com/v1/bpi/currentprice.json');
            $response = json_decode($response->getBody()->getContents(), true);

            if(isset($response['bpi'][$currencyCode]['rate']))
            {
                $rate = $response['bpi'][$currencyCode]['rate'];
            }
        }
        elseif(in_array($currencyCode, array('BTC', 'NLG')))
        {
            // Powered by Bittrex
            $response = $this->client->get('http://bittrex.com/api/v1.1/public/getticker?market=BTC-NLG');
            $response = json_decode($response->getBody()->getContents(), true);

            if(isset($response['result']['Last']))
            {
                $rate = $response['result']['Last'];
            }
        }

        return str_replace(',', '', $rate);
    }
}
