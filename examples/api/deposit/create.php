<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Deposit;
use Nocks\SDK\Model\PaymentMethod;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$deposit = new Deposit();
	$deposit->setAmount('500');
	$deposit->setCurrency('EUR');
	$deposit->setPaymentMethod(new PaymentMethod([
		'method' => 'sepa',
	]));

	$createdDeposit = $nocksApi->deposit->create($deposit);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
