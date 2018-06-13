<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$nocksApi->transaction->cancel('3f2d4e08-9661-4792-89ea-80bc436d6933');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
