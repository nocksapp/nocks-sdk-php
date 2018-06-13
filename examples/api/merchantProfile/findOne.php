<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchantProfile = $nocksApi->merchantProfile->findOne('50cb73dc-78b3-42e6-90ab-4869a29e9248', 'c2ef4a6d-5ac4-4229-901c-1b9cbfcf754a');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
