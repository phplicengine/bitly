[![Latest Stable Version](https://poser.pugx.org/phplicengine/phplicengine-api/v/stable)](https://packagist.org/packages/phplicengine/phplicengine-api)
[![Total Downloads](https://poser.pugx.org/phplicengine/phplicengine-api/downloads)](https://packagist.org/packages/phplicengine/phplicengine-api)

# Bitly v4 API

## Contents
* [Usage](#usage)
* [Installation](#installation)
* [Sample](#sample)
* [Manual](#manual)
* [Changelog](#changelog)
* [License](#license)

## Installation
```
composer require phplicengine/bitly
```

## Sample
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

#### Custom cURL Options
If you need to add some CURLOPT_* constants that are not enabled by default, you can call setCurlCallback() method to add them.

```php
use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink("API KEY GOES HERE");
$bitlink->setCurlCallback(function($ch, $params, $headers, $method) { 
      curl_setopt($ch, CURLOPT_*, 'some value'); 
}); 
```
This is added for your convenience, but you should not need it.

#### Service Classes
For service classes usage, See [here](https://github.com/phplicengine/phplicengine-api/tree/master/examples).

## Changelog
New methods: (v2.x.x)
```php
// for logging purposes only:
print($api->getResponse());
print_r($api->getRequest());

// Sets the host:port of a proxy to be used by cURL. If this is not set,  
// no proxy is used. For example, $api->setCurlProxy('proxy.example.com:3128');  
$api->setCurlProxy($proxy); 
```
New methods: (v2.2.2)

Added `patch()` method.

## License
PHPLicengine Api is distributed under the Apache License. See [License](https://github.com/phplicengine/phplicengine-api/blob/master/LICENSE).

