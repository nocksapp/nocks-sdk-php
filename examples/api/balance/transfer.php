<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\BalanceTransfer;
use Nocks\SDK\NocksApi;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$balance = new BalanceTransfer();
	$balance->setAmount('12');
	$balance->setBalanceFrom('723b8c0a-d802-4e3f-8347-a53c12ced0b8');
	$balance->setBalanceTo('83123d4c-fb85-4584-b93f-f4b08eeaaaee');

	$result = $nocksApi->balance->transfer($balance);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}