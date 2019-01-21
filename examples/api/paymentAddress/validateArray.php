<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\PaymentAddress;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$addresses = [
		new PaymentAddress([
			'currency' => 'NLG',
			'address' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo',
		]),
		new PaymentAddress([
			'currency' => 'EUR',
			'address' => '	NL91ABNA0417164300',
		])
	];

	$validation = $nocksApi->paymentAddress->validateArray($addresses);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
