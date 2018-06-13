<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$result = $nocksApi->merchantClearing->find('c2f04749-2088-4419-9b92-c0aab80287f2');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
