<?php

require '../../../vendor/autoload.php';


use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$payment = $nocksApi->transactionPayment->findOne('fbe940b3-5b9d-472e-b9d5-265041225928');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
