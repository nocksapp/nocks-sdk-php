<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\FundingSource;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$payment = $nocksApi->fundingSource->create(new FundingSource([
		'currency' => 'NLG',
		'number' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo'
	]), '123456');
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
