<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$clientId = '5';
	$clientSecret = 'TaGM5fc2c8uSWVDNlus63HWyUjZvdP45ZbfoJgW7';
	$redirectUri = 'https://www.example.com';

	$nocksOauth = new NocksOauth(Platform::SANDBOX, $clientId, $clientSecret, null, $redirectUri);

	$code = '123';
	$token = $nocksOauth->requestToken($code);
} catch (\Exception $e) {
	echo $e->getMessage();
}