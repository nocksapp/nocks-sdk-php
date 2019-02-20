<?php

require '../../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;
use Nocks\SDK\Model\NotificationFilter;

try {
	$accessToken = 'your_access_token';
	$nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

	$notificationFilter = new NotificationFilter();
	$notificationFilter->setUuid('05ff75ca-ae44-49e0-8efc-8af98a5124d5');
	$notificationFilter->setTarget('http://www.example.com/callback');

	$updatedNotificationFilter = $nocksApi->notificationFilter->update($notificationFilter);
} catch (\Nocks\SDK\Exception\Exception $e) {
	echo $e->getMessage();
}