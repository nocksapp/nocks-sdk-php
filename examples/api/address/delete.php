<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->address->delete('4ae0423c-b70d-4718-aad5-9952e727b20b');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
