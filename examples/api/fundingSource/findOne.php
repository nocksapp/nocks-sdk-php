<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$fundingSource = $nocksApi->fundingSource->findOne('11e8ca4f-6508-42fa-81e1-8399f51a9192');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
