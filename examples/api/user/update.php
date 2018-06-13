<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\User;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$user = new User([
		'locale' => 'nl_NL'
	]);
	$user->setUuid('cc662f79-4e0b-417d-8f81-6a4e2d00e0b5');

	$updatedUser = $nocksApi->user->update($user, '123456');

} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
