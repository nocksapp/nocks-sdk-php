[![Latest Stable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/stable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Total Downloads](https://poser.pugx.org/nocksapp/nocks-sdk-php/downloads)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/unstable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)

# Nocks PHP SDK

---

- [Installation](#installation)
- [Installation without composer](#installation-without-composer)
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

## Installation without composer

If you don't have experience with composer, it is possible to use the SDK without using composer.

You can download the zip on the projects [releases](https://github.com/nocksapp/nocks-sdk-php/releases) page.

1. Download the package zip.
2. Unzip the contents of the zip, and upload the vendor directory to your server.
3. In your project, require the file vendor/autoload.php
4. You can now use the SDK in your project

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