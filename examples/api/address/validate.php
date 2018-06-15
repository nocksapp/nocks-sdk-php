<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\AddressValidation;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$validation = $nocksApi->address->validate(new AddressValidation([
		'currency' => 'NLG',
		'address' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo',
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
