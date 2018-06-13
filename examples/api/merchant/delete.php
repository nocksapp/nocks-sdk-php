<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->merchant->delete('728d4d09-0edc-4ded-96b0-0a3672e5952e');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
