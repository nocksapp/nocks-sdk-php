<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\TradeOrder;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$tradeOrder = $nocksApi->tradeOrder->create(new TradeOrder([
		'trade-market' => 'NLG-EUR',
		'amount' => '100',
		'side' => 'sell',
		'rate' => '1.000',
		'label' => 'Test'
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
