<?php

require '../../../vendor/autoload.php';


use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\PaymentRefund;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->transactionPayment->refund('8bdd1442-f3fb-4e67-ace5-998c247d3534', new PaymentRefund([
		'refund_address' => 'TRt152vKGMdYUZCQutSxaHs8fYcbnmKTRM',
		'description' => 'test'
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
