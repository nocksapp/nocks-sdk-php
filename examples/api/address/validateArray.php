<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Address;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$addresses = [
		new Address([
			'currency' => 'NLG',
			'address' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo',
		]),
		new Address([
			'currency' => 'EUR',
			'address' => '	NL91ABNA0417164300',
		])
	];

	$validation = $nocksApi->address->validateArray($addresses);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
