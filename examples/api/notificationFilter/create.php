<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\Model\NotificationFilter;
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$notificationFilter = new NotificationFilter([
		'method' => 'callback',
		'target' => 'https://nocks.com/callback',
		'resources' => ['user', 'balance'],
	]);

	$createdNotificationFilter = $nocksApi->notificationFilter->create($notificationFilter);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}
