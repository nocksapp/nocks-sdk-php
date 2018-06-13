<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Withdrawal;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$withdrawal = new Withdrawal([
		'currency' => 'NLG',
		'amount' => '20',
		'address' => 'TB82wRPVSkS5pQmLVNeh8Z1zrQLAgWGZxo',
	]);

	$createdWithdrawal = $nocksApi->withdrawal->create($withdrawal);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}