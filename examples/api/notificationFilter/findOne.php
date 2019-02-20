<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$notificationFilter = $nocksApi->notificationFilter->findOne('05ff75ca-ae44-49e0-8efc-8af98a5124d5');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
