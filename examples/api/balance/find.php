<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Constant\Platform;
use Nocks\SDK\NocksApi;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$page = 1;
	$result = $nocksApi->balance->find($page);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}