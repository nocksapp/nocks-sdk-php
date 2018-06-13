<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\MerchantProfileTurnover;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchantUuid = '50cb73dc-78b3-42e6-90ab-4869a29e9248';
	$merchantProfileUuid = 'c2ef4a6d-5ac4-4229-901c-1b9cbfcf754a';

	$turnover = new MerchantProfileTurnover();
	$turnover->setStart('2018-01-01 00:00:00');
	$turnover->setEnd('2018-12-31 23:59:59');

	$turnoverReport = $nocksApi->merchantProfile->turnover($merchantUuid, $merchantProfileUuid, $turnover);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
