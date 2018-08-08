<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\Balance;
use Nocks\SDK\NocksApi;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$balance = new Balance();
	$balance->setType('merchant');
	$balance->setCurrency('EUR');
	$balance->setMerchant('50cb73dc-78b3-42e6-90ab-4869a29e9248');

	$result = $nocksApi->balance->create($balance);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}