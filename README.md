[![Latest Stable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/stable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Total Downloads](https://poser.pugx.org/nocksapp/nocks-sdk-php/downloads)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/unstable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)

# Nocks PHP SDK

---

- [Installation](#installation)
- [Quick start and examples](#quick-start-and-examples)

---

## Installation

This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: [https://github.com/composer/composer](https://github.com/composer/composer)

To install the Nocks PHP sdk into your project, simply

```
$ composer require nocksapp/nocks-sdk-php
```

## Quick start and examples

###Setup

```php
require __DIR__ . '/vendor/autoload.php';

$nocks = new \Nocks\SDK\Nocks();
```

###Create a transaction

```php
$optionalParamaters = array();
$nocks->createTransaction('BTC_NLG', 99.95, 'GcKNJKkTyPpt25LYkPjTCb5Sw6VvRbWds9', $optionalParamaters);
```

Optional transaction paramaters

| Key | Example value | Default | Description |
| :--- | :--- | :--- | :--- |
| amountType | withdrawal, deposit | withdrawal | Amount is provided for withdrawal or deposit. |
| fee | withdrawal, deposit | deposit | Apply fee on withdrawal or deposit |
| responseUrl | https://yourwebsite.com/nocks/response | | Will be called with a POST value 'transactionId' when the status of a transaction changes. |
| returnUrl | https://yourwebsite.com/nocks/return | | URL where the customer is supposed to return to after the payment is completed. |
| incomingPaymentMethod | ideal, wiretransfer, giropay, bancontact | | Only to be used with EUR_* pairs |
| bank | {bankID} | | Only to be used with iDEAL. Can be retrieved by [iDEAL issuers](#retrieve-a-list-of-ideal-issuers) |

Succes response

```php
array(1) {
	["success"] => array(10) {
		["status"] => "pending",
		["transactionId"] => "ef51c5593f601f4c49ae5d4fd9634b1e",
		["pair"] => "BTC_NLG",
		["withdrawal"] => "GcKNJKkTyPpt25LYkPjTCb5Sw6VvRbWds9",
		["withdrawalAmount"] => "99.95000",
		["withdrawalTransactionId"] => NULL,
		["deposit"] => "1NoXgmApDJykYKeb6oVe8KovkSfHqGmuvX",
		["depositAmount"] => "0.00104",
		["depositTransactionId"] => NULL,
		["expiration"] => "2016-09-15 21:39:40"
	}
}
```

Error response

```php
array(1) {
	["error"] => array(1) {
		[0] => "Please fill in a valid Gulden address."
	}
}
```

###Transactions for merchants

To use the Nocks API as a merchant, please [create a free account](https://nocks.co/user/register).

```php
$nocks->setMerchantApiKey('7e0866d53e134224e7251baf8568075d');

$optionalParamaters = array();
$nocks->createMerchantTransaction('NLG', 99.95, $optionalParamaters);
```

###Retrieve a list of payment methods

```php
$nocks->listPaymentMethods();
```

###Retrieve a list of iDEAL issuers

```php
$nocks->listBanks();
```

## API documentation
If you wish to learn more about our API, please visit the [Nocks API](https://nocks.co/api).

## Support
Contact [www.nocks.co](https://nocks.co/support) - [support@nocks.co](mailto:support@nocks.co).
