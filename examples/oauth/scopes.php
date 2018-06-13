<?php

require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
	$nocksOauth = new NocksOauth(Platform::SANDBOX);
	$scopes = $nocksOauth->scopes();
} catch (\Exception $e) {
	echo $e->getMessage();
}