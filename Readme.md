# Bitly v4 API

## Contents
* [Installation](#installation)
* [Usage](#usage)
* [Manual](#manual)
* [Caching](#caching)
* [License](#license)

## Installation
```
composer require phplicengine/bitly
```

## Usage
```php

use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink("API KEY GOES HERE");
$result = $bitlink->createBitlink(['long_url' => 'http://www.example.com']);

if ($bitlink->isCurlError()) {
    
    // If curl retruns error.
    print ($bitlink->getCurlErrno().': '.$bitlink->getCurlError());  
    
} else {

    // If Bitly returns error message
    if ($result->isError()) { 

        print("Error:<br />");
        print($result->getResponse());
        print($result->getDescription());
    
    } else {
    
       // If this is 200 or 201 by Bitly
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

// Below is for debug purposes only.
print("INFO:<br />");

$res = $result->getResponse(); //It returns the response as it is. In this case in json format
print_r($res."<br />");

$reso = $result->getResponseObject(); //It decodes json response. stdClass object.
print_r($reso);

$resh = $result->getHeaders(); //It returns header of server.
print_r($resh);

$resr = $bitlink->getRequest(); //It returns the request.
print_r($resr);
```

## Manual

#### Service Classes

In [Bitly v4 API](https://dev.bitly.com/v4/) documentations, resources are classified under serveral categories:

Bitlink, Group, Organization, User, Custom, Campaign, Bsd, App, Auth

We made each of them as a separate service class. Method names are the same as the last part of documentation url.
For example if you want to use [Get Metrics for a Bitlink by countries](https://dev.bitly.com/v4/#operation/getMetricsForBitlinkByCountries), this one is classified under Bitlink category in documentation and the last part of its url is `getMetricsForBitlinkByCountries`, so you can call it this way:

```php
use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink("API KEY GOES HERE");
$result = $bitlink->getMetricsForBitlinkByCountries('bit.ly/34nRNvl', ['unit' => 'day', 'units' => -1]);
```

Or you can set api key later:

```php
use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink();
$bitlink->setApiKey("API KEY GOES HERE");
$result = $bitlink->getMetricsForBitlinkByCountries('bit.ly/34nRNvl', ['unit' => 'day', 'units' => -1]);
```

All Path parameters, must be passed as string in first argument of methods if necessary and all Query parameters must be passed as array in second argument of methods if necessary. If Path parameter is not needed, Query parameters will be first argument of methods.

Another example:

[Retrieve Group Shorten Counts](https://dev.bitly.com/v4/#operation/getGroupShortenCounts) is classified under Group category, and the last part of its link is `getGroupShortenCounts`, so you can call it this way:

```php
use PHPLicengine\Service\Group;
$bitlink = new Group("API KEY GOES HERE");
$result = $bitlink->getGroupShortenCounts($group_guid);
```

Here is [list of available service classes and methods](Services.md).

#### Custom cURL Options

By default cURL timeout is 30. You can change it with:
```php
$bitlink->setTimeout(30);
```

If you need to add some CURLOPT_* constants that are not enabled by default, you can call setCurlCallback() method to add them.

```php
use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink("API KEY GOES HERE");
$bitlink->setCurlCallback(function($ch, $params, $headers, $method) { 
      curl_setopt($ch, CURLOPT_*, 'some value'); 
}); 
```
This is added for your convenience, but you should not need it.

## Caching
Since Bitlinks never change or expire, this is recommended to cache data locally wherever possible. This library comes with Doctrine Cache. You can use cache like this:
```php
use PHPLicengine\Cache;
$adapter = new Cache(['type' => 'file', 'path' => 'path/to/cache/folder']);
$cache = $adapter->getCache();
$cache->set('key', 'value');
echo $cache->get('key') // prints "value"
```
We suggest to look at [Doctrine Cache](https://www.doctrine-project.org/projects/doctrine-cache/en/1.8/index.html) and investigate and customize [Cache class](lib/PHPLicengine/Cache.php) to use preferred cache type.

## License
PHPLicengine Api is distributed under the Apache License. See [License](LICENSE).

