<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$withdrawal = $nocksApi->withdrawal->findOne('b26fc003-04b6-4748-9e4c-4f5a0855a47a');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}