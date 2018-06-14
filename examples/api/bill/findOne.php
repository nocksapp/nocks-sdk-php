<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$bill = $nocksApi->bill->findOne('b583facf-74aa-4976-b97e-90702643a598');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}