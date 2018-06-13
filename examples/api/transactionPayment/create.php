<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Currency;
use Nocks\SDK\Model\Payment;
use Nocks\SDK\Model\PaymentMethod;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$payment = $nocksApi->transactionPayment->create('3f2d4e08-9661-4792-89ea-80bc436d6933', new Payment([
		'amount' => new Currency([
			'value' => 250,
			'currency' => 'NLG',
		]),
		'payment_method' => new PaymentMethod([
			'method' => 'gulden',
		]),
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
