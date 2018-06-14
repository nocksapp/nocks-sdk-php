<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$result = $nocksApi->transaction->find(['page' => 1, 'status' => 'cancelled']);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
