<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Currency;
use Nocks\SDK\Model\PaymentMethod;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\Bill;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$bill = new Bill();
	$bill->setType('send');
	$bill->setName('John Do');
	$bill->setFrequence('once');
	$bill->setDescription('Hello');
	$bill->setDateStart('2019-07-01');
	$bill->setAddress('NL63BUNQ9900005074');
	$bill->setPaymentMethod(new PaymentMethod([
		'method' => 'ideal',
		'metadata' => [
			'issuer' => 'ABNANL2A'
		]
	]));

	$amount = new Currency();
	$amount->setCurrency('EUR');
	$amount->setValue(10);
	$bill->setAmount($amount);

	$createdBill = $nocksApi->bill->create($bill);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}