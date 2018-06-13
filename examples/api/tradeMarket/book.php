<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$book = $nocksApi->tradeMarket->book('NLG-EUR');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
