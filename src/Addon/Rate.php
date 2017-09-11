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
            $btc_eur = $this->getCurrentRate('EUR');

            $response = $this->client->get('http://nocks.co/api/market?call=nlg', [
                'headers' => [
                    'Accept' => '*/*'
                ]
            ]);

            $response = json_decode($response->getBody()->getContents(), true);

            if(isset($response['last']))
            {
                $rate = number_format($response['last'] / $btc_eur, 8);
            }
        }

        return str_replace(',', '', $rate);
    }
}
