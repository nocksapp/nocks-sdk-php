<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\Merchant;
use Nocks\SDK\Model\MerchantClearingDistribution;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$merchant = new Merchant([
		'name' => 'Nocks B.V.',
		'email' => 'support@nocks.co',
		'website' => 'https://nocks.co',
		'address' => 'Dorpstraat',
		'number' => '24',
		'zip_code' => '1234 AB',
		'city' => 'Zoetermeer',
		'country' => 'NL',
		'phone' => '+31612345678',
		'coc' => '64502262',
		'vat' => 'NL855693915B04',
	]);
	$merchant->setClearingDistribution([
		new MerchantClearingDistribution([
			'percentage' => 20,
			'address' => 'TNZQU2V1K3qu8ntzHuJ5336AAUuG8WC6JD',
			'currency' => 'NLG'
		]),
		new MerchantClearingDistribution([
			'percentage' => 80,
			'address' => 'NL16ABNA0602167736',
			'currency' => 'EUR',
		])
	]);

	$createdMerchant = $nocksApi->merchant->create($merchant);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
