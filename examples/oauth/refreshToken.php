<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$clientId = '5';
	$clientSecret = 'TaGM5fc2c8uSWVDNlus63HWyUjZvdP45ZbfoJgW7';

	$nocksOauth = new NocksOauth(Platform::SANDBOX, $clientId, $clientSecret);

	$refreshToken = '123';
	$token = $nocksOauth->refreshToken($refreshToken);
} catch (\Exception $e) {
	echo $e->getMessage();
}