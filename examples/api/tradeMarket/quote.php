<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$quote = $nocksApi->tradeMarket->quote('NLG-EUR', 'buy', 10);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
