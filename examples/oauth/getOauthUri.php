<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$clientId = '5';
	$redirectUri = 'https://www.example.com';
	$scopes = ['user.read'];

	$nocksOauth = new NocksOauth(Platform::SANDBOX, $clientId, null, $scopes, $redirectUri);
	$uri = $nocksOauth->getOauthUri();

	header('Location: ' . $uri);
	die();
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}