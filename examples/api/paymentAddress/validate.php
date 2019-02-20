<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\PaymentAddress;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$paymentAddress = $nocksApi->paymentAddress->validate(new PaymentAddress([
		'currency' => 'NLG',
		'address' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo',
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
