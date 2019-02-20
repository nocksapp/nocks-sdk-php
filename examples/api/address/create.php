<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\Address;
use Nocks\SDK\NocksApi;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$address = new Address();
	$address->setName('Nocks office');
	$address->setStreet1('van Lodensteinstraat 25');
	$address->setStreet2('Floor 3');
	$address->setCity('Zoetermeer');
	$address->setRegion('Zuid-Holland');
	$address->setPostalCode('2722CG');
	$address->setCountry('NL');

	$result = $nocksApi->address->create($address);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
