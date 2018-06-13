<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$nocksOauth = new NocksOauth(Platform::SANDBOX);

	$accessToken = 'your_access_token';
	$tokenScopes = $nocksOauth->tokenScopes($accessToken);
} catch (\Exception $e) {
	echo $e->getMessage();
}
