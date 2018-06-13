<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Currency;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\Bill;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$bill = new Bill();
	$bill->setUuid('436f78d7-5bdf-460b-8f05-d5d011dae6a6');
	$bill->setDescription('Hello');
	$bill->setAmount(new Currency([
		'value' => 200,
		'currency' => 'NLG',
	]));

	$updatedBill = $nocksApi->bill->update($bill);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}