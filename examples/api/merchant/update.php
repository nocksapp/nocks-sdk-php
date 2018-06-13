<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Merchant;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchant = new Merchant([
		'zip_code' => '1235 AZ'
	]);
	$merchant->setUuid('50cb73dc-78b3-42e6-90ab-4869a29e9248');

	$updatedMerchant = $nocksApi->merchant->update($merchant);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
