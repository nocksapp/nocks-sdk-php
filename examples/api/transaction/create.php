<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Currency;
use Nocks\SDK\Model\PaymentMethod;
use Nocks\SDK\Model\Transaction;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$transaction = $nocksApi->transaction->create(new Transaction([
		'source_currency' => 'NLG',
		'target_currency' => 'NLG',
		'target_address' => 'TRt152vKGMdYUZCQutSxaHs8fYcbnmKTRM',
		'amount' => new Currency([
			'value' => 250,
			'currency' => 'NLG',
		]),
		'description' => 'Test transaction',
		'payment_method' => new PaymentMethod([
			'method' => 'gulden'
		]),
		'metadata' => [
			'your_data_example_reference' => '012345',
			'your_data_example_customer_name' => 'NOCKS BV',
		],
		'redirect_url' => 'https://nocks.com/redirect',
		'callback_url' => 'https://nocks.com/callback',
		'locale' => 'nl_NL',
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
