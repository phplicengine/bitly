[![Build Status](https://app.travis-ci.com/phplicengine/bitly.svg?branch=master)](https://app.travis-ci.com/phplicengine/bitly)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/phplicengine/bitly/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/phplicengine/bitly/?branch=master)
[![Latest Stable Version](https://img.shields.io/packagist/v/phplicengine/bitly?label=version)](https://packagist.org/packages/phplicengine/bitly)
[![Total Downloads](https://img.shields.io/packagist/dt/phplicengine/bitly?color=blue)](https://packagist.org/packages/phplicengine/bitly)
[![Release date](https://img.shields.io/github/release-date/phplicengine/bitly)](https://packagist.org/packages/phplicengine/bitly)
[![php](https://img.shields.io/packagist/php-v/phplicengine/bitly)](https://packagist.org/packages/phplicengine/bitly)
[![License](https://img.shields.io/packagist/l/phplicengine/bitly)](https://packagist.org/packages/phplicengine/bitly)



# Bitly API v4

## Contents
* [Installation](#installation)
* [Usage](#usage)
* [Manual](#manual)
* [Contributing and Support](#contributing-and-support)
* [License](#license)

## Installation
```
composer require phplicengine/bitly
```

## Usage
```php
use PHPLicengine\Api\Api;
use PHPLicengine\Service\Bitlink;

$api = new Api("API KEY GOES HERE");
$bitlink = new Bitlink($api);
$result = $bitlink->createBitlink(['long_url' => 'http://www.example.com']);

// if cURL error occurs.
if ($api->isCurlError()) {
    
    print($api->getCurlErrno().': '.$api->getCurlError());
    
} else {

    // if Bitly response contains error message.
    if ($result->isError()) {

        print("Error:<br />");
        print($result->getResponse());
        print($result->getDescription());
    
    } else {
    
        // if Bitly response is 200 or 201
        if ($result->isSuccess()) {
        
            print("SUCCESS:<br />");
            print($result->getResponse());
            print_r($result->getResponseArray());

        } else {

            print("FAIL:<br />");
            print($result->getResponse());
            print_r($result->getResponseArray());

        }
    }
}

// for debug only.
print("INFO:<br />");

// returns response exactly as it is. e.g. json.
$resj = $result->getResponse();
print($resj."<br />");

// returns decoded json.
$reso = $result->getResponseObject();
print_r($reso);

// returns header of server.
$resh = $result->getHeaders();
print_r($resh);

// returns request.
$resr = $api->getRequest();
print_r($resr);
```

## Manual

#### Service Classes

In [Bitly API v4](https://dev.bitly.com/api-reference) documentations, resources are classified under serveral categories:

Bitlink, Group, Organization, User, Custom, Campaign, Bsd, OAuth, Auth, Webhook

We made each of them as a separate service class. Method names are the same as the last part of documentation url.
For example if you want to use [Get Metrics for a Bitlink by Country](https://dev.bitly.com/api-reference#getMetricsForBitlinkByCountries), this one is classified under Bitlink category in documentation and the last part of its url is `getMetricsForBitlinkByCountries`, so you can call it this way:

```php
use PHPLicengine\Api\Api;
use PHPLicengine\Service\Bitlink;

$api = new Api("API KEY GOES HERE");
$bitlink = new Bitlink($api);
$result = $bitlink->getMetricsForBitlinkByCountries('bit.ly/34nRNvl', ['unit' => 'day', 'units' => -1]);
```

All Path parameters, must be passed as string in first argument of methods if necessary and all Query parameters must be passed as array in second argument of methods if necessary. If Path parameter is not needed, Query parameters will be first argument of methods.

Another example:

[Retrieve Group Shorten Counts](https://dev.bitly.com/api-reference#getGroupShortenCounts) is classified under Group category, and the last part of its link is `getGroupShortenCounts`, so you can call it this way:

```php
use PHPLicengine\Api\Api;
use PHPLicengine\Service\Group;

$api = new Api("API KEY GOES HERE");
$group = new Group($api);
$result = $group->getGroupShortenCounts($group_guid);
```

Here is [list of available service classes and methods](Services.md).

#### Custom cURL Options

By default cURL timeout is 30. You can change it with:
```php
$api->setTimeout(30);
```

If you need to add some CURLOPT_* constants that are not enabled by default, you can call setCurlCallback() method to add them.

```php
use PHPLicengine\Api\Api;
use PHPLicengine\Service\Bitlink;

$api = new Api("API KEY GOES HERE");
$api->setCurlCallback(function($ch, $params, $headers, $method) { 
      curl_setopt($ch, CURLOPT_*, 'some value'); 
}); 
$bitlink = new Bitlink($api);
```
This is added for your convenience, but you should not need it.

## Contributing and Support
For all issues or feature request or support questions please open a new [issue](https://github.com/phplicengine/bitly/issues). All pull requests are welcome.

## License
PHPLicengine Api is distributed under the Apache License. See [License](LICENSE).
