<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$candles = $nocksApi->tradeMarket->candles('NLG-EUR', 1525132800, 1528208419, 3600);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
