<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$tradeOrder = $nocksApi->tradeOrder->findOne('9db8db25-3b38-4516-9bde-809bbe312df8');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
