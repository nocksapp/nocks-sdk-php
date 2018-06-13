<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->user->delete('cc662f79-4e0b-417d-8f81-6a4e2d00e0b5', '123450');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
