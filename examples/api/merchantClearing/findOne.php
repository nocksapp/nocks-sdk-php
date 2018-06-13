<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchantClearing = $nocksApi->merchantClearing->findOne('c2f04749-2088-4419-9b92-c0aab80287f2', '8cc42e73-ca1d-4ba4-a309-076c2fda1800');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
