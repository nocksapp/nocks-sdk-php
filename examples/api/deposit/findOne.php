<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$deposit = $nocksApi->deposit->findOne('cb121a0f-7a6d-4d0c-81a3-7433ee6f626f');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
