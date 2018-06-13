<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->merchantProfile->delete('50cb73dc-78b3-42e6-90ab-4869a29e9248', '2b82682f-3c7b-450a-9677-50b319ac5816');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
