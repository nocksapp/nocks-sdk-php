<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\Address;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$address = new Address();
	$address->setUuid('4ae0423c-b70d-4718-aad5-9952e727b20b');
	$address->setName('Nocks HQ');

	$updatedAddress = $nocksApi->address->update($address);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}