[![Latest Stable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/stable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Total Downloads](https://poser.pugx.org/nocksapp/nocks-sdk-php/downloads)](https://packagist.org/packages/nocksapp/nocks-sdk-php)
[![Latest Unstable Version](https://poser.pugx.org/nocksapp/nocks-sdk-php/v/unstable)](https://packagist.org/packages/nocksapp/nocks-sdk-php)

# Nocks SDK PHP
Nocks SDK PHP is a `php` package for [Nocks](https://docs.nocks.com/). It can be used in any php `>=5.4.0` environment. The `SDK` supports both the calls to the Nocks `api` endpoints as well to the `oauth` endpoints.

---

- [Installation](#installation)
- [Getting started](#getting-started)
- [Examples](#examples)
- [Support](#support)

---

## Installation
This SDK uses composer.

Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.

For more information on how to use/install composer, please visit: https://github.com/composer/composer

To install this SDK into your project with composer, simply use:

`$ composer require nocksapp/nocks-sdk-php`

## Getting Started


### Oauth
The `NocksOauth` class provides the following methods:

* getOauthUri
* requestToken
* refreshToken
* passwordGrantToken
* scopes
* tokenScopes

#### Example
```php
require '../../vendor/autoload.php';

use Nocks\SDK\NocksOauth;
use Nocks\SDK\Constant\Platform;

try {
    $clientId = '1';
    $clientSecret = '1234';
    $scopes = ['user.read'];
    $redirectUri = 'https://www.example.com';

    $nocksOauth = new NocksOauth(Platform::SANDBOX, $clientId, $clientSecret, $scopes, $redirectUri);
    $uri = $nocksOauth->getOauthUri();

    // For example, redirect the user to the Nocks login page
    header('Location: ' . $uri);
    die();
} catch (\Nocks\SDK\Exception\Exception $e) {
    // Handle any SDK exception
}
```

Please checkout the [oauth docs](https://docs.nocks.com/#oauth-applications) and [examples](#examples) to see how the `oauth` methods can be used.

### API
The `NocksApi` class provides all the `Nocks` resources. Please checkout the [resources docs](https://docs.nocks.com/#public-resources) and [examples](#examples).

```php
require '../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
    $accessToken = 'your_access_token';
    $nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

    $user = $nocksApi->user->findAuthenticated();
} catch (\Nocks\SDK\Exception\Exception $e) {
    // Handle any SDK exception
}
```

### Results
The result returned from a method call in the SDK will differ, please check the `PHPDocs` to see what will be returned from a method. Most of the time it will be a `Model` or a `NocksResponse`.

#### Model
A `Model` is just a simple `object` which holds the `data` returned from the api. Each `Model` will provide the necessary `getters` and `setters` for the specific `data`. 

#### NocksResponse
A `NocksResponse` is an object which holds a `data array` and a `pagination object`. This is typically returned from a `.find` method.

Example:
```php
require '../../vendor/autoload.php';

use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
    $accessToken = 'your_access_token';
    $nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

    $result = $nocksApi->transaction->find();
    $result->getPagination(); // Do something with pagination
	
    // Loop through transactions
    foreach ($result->getData() as $transaction) {
        // Do something with the transaction
    }	
} catch (\Nocks\SDK\Exception\Exception $e) {
    // Handle any SDK exception
}
```

### Exceptions
The SDK uses the following exceptions. All exceptions are inherit from `Nocks\SDK\Exception\Exception`.

* Nocks\SDK\Exception\Exception (super)
    * Nocks\SDK\Exception\HttpException (super)
        * Nocks\SDK\Exception\BadRequestException
        * Nocks\SDK\Exception\ForbiddenException
        * Nocks\SDK\Exception\GoneException
        * Nocks\SDK\Exception\InternalServerError
        * Nocks\SDK\Exception\MethodNotAllowedException
        * Nocks\SDK\Exception\NotAcceptable
        * Nocks\SDK\Exception\NotFoundException
        * Nocks\SDK\Exception\ServiceUnavailable
        * Nocks\SDK\Exception\TooManyRequests
        * Nocks\SDK\Exception\UnauthorizedException
    * Nocks\SDK\Exception\ValidationException
    * Nocks\SDK\Exception\ScopeConfigurationException

#### HttpException
A `HttpException` is thrown when a http call to `Nocks` fails. The HttpException is the `super` exception and the actual exception that is thrown is corresponding to the http `statuscode`, see [the documentation](https://docs.nocks.com/#errors).

#### ValidationException
A `ValidationException` may occur when you call a function with `invalid` parameters or when there are `missing` required parameters. For example:

```php
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
    $accessToken = 'your_access_token';
    $nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

    $userToUpdate = new User();
    // $userToUpdate->setUuid('1234'); Will occur in an exception when not set
    $user = $nocksApi->user->update($userToUpdate);
} catch (\Nocks\SDK\Exception\ValidationException $e) {
    // A ValidationException will be thrown when the $userToUpdate has no uuid
}
```

`Note that the SDK doesn't check your request data, if there is something wrong with your data, the http call will resolve in a HttpException`

#### ScopeConfigurationException
A `ScopeConfigurationException` may occur when calling a function which depends on a certain scope parameter that was not provided. For example, calling a `private` resource while there was no `accessToken` configured:

```php
use Nocks\SDK\NocksApi;
use Nocks\SDK\Constant\Platform;

try {
    $accessToken = null;
    $nocksApi = new NocksApi(Platform::SANDBOX, $accessToken);

    $userToUpdate = new User([
        'uuid' => '1234',
        'locale' => 'nl_NL',
    ]);
    $user = $nocksApi->user->update($userToUpdate);
} catch (\Nocks\SDK\Exception\ScopeConfigurationException $e) {
    // A ScopeConfigurationException will be thrown when the $accessToken is null
}
```

## Examples
In the [examples directory](./examples) you will find examples for each call that is supported in this SDK.

## Support
Need help or support? Please check https://www.nocks.com/support.

Found a bug? Please check the existing GitHub issues and open a new issue if necessary. Or even better, create a pull request to directly resolve the issue you have found!
