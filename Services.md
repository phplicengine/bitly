
## Available service classes
Consult [Bitly v4 API](https://dev.bitly.com/v4/) for required and available parameters to pass to each methods. Path parameters must be 
first argument of methods as string if necessary and Query parameters must be passed as an array to the second argument of methods if ncessary. 
If a method doesn't have a Path parameter, Query Parameter will be first argument.

* [Bitlink](#bitlink)
* [Group](#group)
* [Organization](#organization)
* [User](#user)
* [App](#app)
* [Bsd](#bsd)
* [Deeplink](#deeplink)
* [Billing](#billing)
* [Custom](#custom)
* [Campaign](#campaign)
* [Auth](#auth)

### Bitlink:
```php
use PHPLicengine\Service\Bitlink;
$bitlink = new Bitlink('API KEY GOES HERE');
$result = $bitlink->getMetricsForBitlinkByReferrersByDomains('bit.ly/34nRNvl');
$result = $bitlink->getMetricsForBitlinkByCountries('bit.ly/34nRNvl', ['unit' => 'day', 'units' => -1]);
$result = $bitlink->getClicksForBitlink('bit.ly/34nRNvl');
$result = $bitlink->expandBitlink(['bitlink_id' => 'bit.ly/34nRNvl']);
$result = $bitlink->getMetricsForBitlinkByReferrers('bit.ly/34nRNvl');
$result = $bitlink->createFullBitlink(['long_url' => 'http://www.example.com']);
$result = $bitlink->updateBitlink('bit.ly/34nRNvl', ['title' => 'New Title']);
$result = $bitlink->getBitlink('bit.ly/34nRNvl');
$result = $bitlink->getClicksSummaryForBitlink('bit.ly/34nRNvl');
$result = $bitlink->createBitlink(['long_url' => 'http://www.example.com']);
$result = $bitlink->getMetricsForBitlinkByReferringDomains('bit.ly/34nRNvl');
```

### Group:
```php
use PHPLicengine\Service\Group;
$bitlink = new Group('API KEY GOES HERE');
$result = $bitlink->getGroupTags('Bjar7NnSIp0');
$result = $bitlink->getGroupMetricsByReferringNetworks('Bjar7NnSIp0');
$result = $bitlink->getGroupShortenCounts('Bjar7NnSIp0');
$result = $bitlink->getGroups();
$result = $bitlink->getGroupPreferences('Bjar7NnSIp0');
$result = $bitlink->updateGroupPreferences('Bjar7NnSIp0', ['group_guid' => '']);
$result = $bitlink->getBitlinksByGroup('Bjar7NnSIp0');
$result = $bitlink->getGroupMetricsByCountries('Bjar7NnSIp0');
$result = $bitlink->getSortedBitlinks('Bjar7NnSIp0', ['unit' => 'day', 'units' => -1]);
$result = $bitlink->updateGroup('Bjar7NnSIp0', ['name' => 'new name']);
$result = $bitlink->getGroup('Bjar7NnSIp0');
$result = $bitlink->deleteGroup('Bjar7NnSIp0');
```

### Organization:
```php
use PHPLicengine\Service\Organization;
$bitlink = new Organization('API KEY GOES HERE');
$result = $bitlink->getOrganizations();
$result = $bitlink->getOrganizationShortenCounts('Ojar7LjM8Bd');
$result = $bitlink->getOrganization('Ojar7LjM8Bd');
$result = $bitlink->getPaymentInvoices('Ojar7LjM8Bd');
```

### User:
```php
use PHPLicengine\Service\User;
$bitlink = new User('API KEY GOES HERE');
$result = $bitlink->updateUser(['default_group_guid' => 'Ojar7LjM8Bd', 'name' => 'new name']);
$result = $bitlink->getUser();
$result = $bitlink->addEmailToUser($user, ['email' => $email]);
```

### App:
```php
use PHPLicengine\Service\App;
$bitlink = new App('API KEY GOES HERE');
$result = $bitlink->getOAuthApp($client_id);
```

### Bsd:
```php
use PHPLicengine\Service\Bsd;
$bitlink = new Bsd('API KEY GOES HERE');
$result = $bitlink->getBSDs();
```

### Deeplink:
```php
use PHPLicengine\Service\Deeplink;
$bitlink = new Deeplink('API KEY GOES HERE');
$result = $bitlink->thirdPartyAppLookup(['third_party_app_id' => 'some value', 'os' => 'android']);
```

### Billing:
```php
use PHPLicengine\Service\Billing;
$bitlink = new Billing('API KEY GOES HERE');
$result = $bitlink->getPaymentInvoices('Ojar7LjM8Bd');
```

### Custom:
```php
use PHPLicengine\Service\Custom;
$bitlink = new Custom('API KEY GOES HERE');
$result = $bitlink->updateCustomBitlink('bit.ly/34nRNvl', ['bitlink_id' => 'bit.ly/34nRNvl']);
$result = $bitlink->getCustomBitlink('bit.ly/34nRNvl');
$result = $bitlink->addCustomBitlink(['bitlink_id' => 'bit.ly/34nRNvl', 'custom_bitlink' => 'bit.ly/34furnr']);
$result = $bitlink->getCustomBitlinkMetricsByDestination('bit.ly/34nRNvl');
```

### Campaign:
```php
use PHPLicengine\Service\Campaign;
$bitlink = new Campaign('API KEY GOES HERE');
$result = $bitlink->createChannel(['group_guid' => 'Bjar7NnSIp0', 'name' => 'some name']);
$result = $bitlink->getChannels(['group_guid' => 'Bjar7NnSIp0']);
$result = $bitlink->createCampaign(['group_guid' => 'Bjar7NnSIp0', 'channel_guids' => ['some value']]);
$result = $bitlink->getCampaigns(['group_guid' => 'Bjar7NnSIp0']);
$result = $bitlink->getCampaign($campaign_guid);
$result = $bitlink->updateCampaign('$campaign_guid', ['group_guid' => 'some value']);
$result = $bitlink->getChannel($channel_guid);
$result = $bitlink->updateChannel('$channel_guid', ['group_guid' => 'some value']);
```

### Auth:
If you want to use [Exchanging a Username and Password for an Access Token](https://dev.bitly.com/v4/#section/Exchanging-a-Username-and-Password-for-an-Access-Token)
set `$client_id` and `$client_secret` as first and second arguments of Auth class constructor respectively, and pass `$bitlyusername` and 
`$bitlypassword` as an array to `exchangeToken()` method:

```php
use PHPLicengine\Service\Auth;
$params['username']= '';
$params['password'] = '';
$bitlink = new Auth($client_id, $client_secret);
$token = $bitlink->exchangeToken($params);
```

If you want to use [HTTP Basic Authentication Flow](https://dev.bitly.com/v4/#section/HTTP-Basic-Authentication-Flow)
set `$bitlyusername` and `$bitlypassword` as first and second arguments of Auth class constructor respectively, and pass `$client_id` and 
`$client_secret` as an array to `basicAuthFlow()` method:

```php
use PHPLicengine\Service\Auth;
$params['client_id'] = "";
$params['client_secret'] = "";
$bitlink = new Auth($bitlyusername, $bitlypassword);
$token = $bitlink->basicAuthFlow($params);
```
