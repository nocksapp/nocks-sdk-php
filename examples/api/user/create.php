<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\User;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$nocksApi = new NocksApi(Platform::SANDBOX);

	$user = $nocksApi->user->create(new User([
		'gender' => 'male',
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'johndoe@nocks.co',
        'password' => 'S3cretPassw0rd',
		'locale' => 'nl_NL',
	]));
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
