<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->bill->delete('13382aaa-a4dc-4e34-b275-a9266cc4dd1a');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}