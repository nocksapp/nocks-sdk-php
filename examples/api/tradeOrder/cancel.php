<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->tradeOrder->cancel('695c740c-b976-44d5-90d7-5142ff6eac57');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
