<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchantInvoice = $nocksApi->merchantInvoice->findOne('c2f04749-2088-4419-9b92-c0aab80287f2', 'b74adcd5-5c52-42b2-b3a3-bc40c5a7fbe7');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
