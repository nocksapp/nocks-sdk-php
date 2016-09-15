[![Latest Stable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/stable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Total Downloads](https://poser.pugx.org/nocksapp/nocks-sdk-php/downloads)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/unstable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)

# Nocks PHP SDK

---

- [Installation](#installation)
- [Installation without composer](#installation-without-composer)
- [Quick start and examples](#quick-start-and-examples)

---

### Installation

This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: [https://github.com/composer/composer](https://github.com/composer/composer)

To install the Nocks PHP sdk into your project, simply

$ composer require nocksapp/nocks-sdk-php

### Installation without composer

If you don't have experience with composer, it is possible to use the SDK without using composer.

You can download the zip on the projects [releases](https://github.com/nocksapp/nocks-sdk-php/releases) page.

1. Download the package zip.
2. Unzip the contents of the zip, and upload the vendor directory to your server.
3. In your project, require the file vendor/autoload.php
4. You can now use the SDK in your project

### Quick start and examples

Setup

```php
require __DIR__ . '/vendor/autoload.php';

$nocks = new \Nocks\SDK\Nocks();
```