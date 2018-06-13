<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$clientId = '7';
	$clientSecret = 'ZbfZkDJT6dNmVwSZhr6W0CueY82olTthKcKH2nNP';
	$scopes = ['user.read'];

	$nocksOauth = new NocksOauth(Platform::SANDBOX, $clientId, $clientSecret, $scopes);
	$tokens = $nocksOauth->passwordGrantToken('robbieopdeweegh@gmail.com', '6c0bdo3UT2tB');
} catch (\Exception $e) {
	echo $e->getMessage();
}