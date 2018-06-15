<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$setting = $nocksApi->setting->get();
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
