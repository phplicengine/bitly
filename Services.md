
## Available service classes
Consult [Bitly API v4](https://dev.bitly.com/v4/) for required and available parameters to pass to each methods. Path parameters must be 
first argument of methods as string if necessary and Query parameters must be passed as an array to the second argument of methods if ncessary. 
If a method doesn't have a Path parameter, Query Parameter will be first argument.

* [Bitlink](#bitlink)
* [Group](#group)
* [Organization](#organization)
* [User](#user)
* [App](#app)
* [Bsd](#bsd)
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
$group = new Group('API KEY GOES HERE');
$result = $group->getGroupTags('Bjar7NnSIp0');
$result = $group->getGroupMetricsByReferringNetworks('Bjar7NnSIp0');
$result = $group->getGroupShortenCounts('Bjar7NnSIp0');
$result = $group->getGroups();
$result = $group->getGroupPreferences('Bjar7NnSIp0');
$result = $group->updateGroupPreferences('Bjar7NnSIp0', ['group_guid' => '']);
$result = $group->getBitlinksByGroup('Bjar7NnSIp0');
$result = $group->getGroupMetricsByCountries('Bjar7NnSIp0');
$result = $group->getSortedBitlinks('Bjar7NnSIp0', ['unit' => 'day', 'units' => -1]);
$result = $group->updateGroup('Bjar7NnSIp0', ['name' => 'new name']);
$result = $group->getGroup('Bjar7NnSIp0');
$result = $group->deleteGroup('Bjar7NnSIp0');
```

### Organization:
```php
use PHPLicengine\Service\Organization;
$organization = new Organization('API KEY GOES HERE');
$result = $organization->getOrganizations();
$result = $organization->getOrganizationShortenCounts('Ojar7LjM8Bd');
$result = $organization->getOrganization('Ojar7LjM8Bd');
$result = $organization->getPaymentInvoices('Ojar7LjM8Bd');
```

### User:
```php
use PHPLicengine\Service\User;
$user = new User('API KEY GOES HERE');
$result = $user->updateUser(['default_group_guid' => 'Ojar7LjM8Bd', 'name' => 'new name']);
$result = $user->getUser();
```

### App:
```php
use PHPLicengine\Service\App;
$app = new App('API KEY GOES HERE');
$result = $app->getOAuthApp($client_id);
```

### Bsd:
```php
use PHPLicengine\Service\Bsd;
$bsd = new Bsd('API KEY GOES HERE');
$result = $bsd->getBSDs();
```

### Custom:
```php
use PHPLicengine\Service\Custom;
$custom = new Custom('API KEY GOES HERE');
$result = $custom->updateCustomBitlink('bit.ly/34nRNvl', ['bitlink_id' => 'bit.ly/34nRNvl']);
$result = $custom->getCustomBitlink('bit.ly/34nRNvl');
$result = $custom->addCustomBitlink(['bitlink_id' => 'bit.ly/34nRNvl', 'custom_bitlink' => 'bit.ly/34furnr']);
$result = $custom->getCustomBitlinkMetricsByDestination('bit.ly/34nRNvl');
```

### Campaign:
```php
use PHPLicengine\Service\Campaign;
$campaign = new Campaign('API KEY GOES HERE');
$result = $campaign->createChannel(['group_guid' => 'Bjar7NnSIp0', 'name' => 'some name']);
$result = $campaign->getChannels(['group_guid' => 'Bjar7NnSIp0']);
$result = $campaign->createCampaign(['group_guid' => 'Bjar7NnSIp0', 'channel_guids' => ['some value']]);
$result = $campaign->getCampaigns(['group_guid' => 'Bjar7NnSIp0']);
$result = $campaign->getCampaign($campaign_guid);
$result = $campaign->updateCampaign('$campaign_guid', ['group_guid' => 'some value']);
$result = $campaign->getChannel($channel_guid);
$result = $campaign->updateChannel('$channel_guid', ['group_guid' => 'some value']);
```

### Auth:
If you want to use [Exchanging a Username and Password for an Access Token](https://dev.bitly.com/v4/#section/Exchanging-a-Username-and-Password-for-an-Access-Token)
set `$client_id` and `$client_secret` as first and second arguments of Auth class constructor respectively, and pass `$bitlyusername` and 
`$bitlypassword` as an array to `exchangeToken()` method:

```php
use PHPLicengine\Service\Auth;
$params['username']= '';
$params['password'] = '';
$auth = new Auth($client_id, $client_secret);
$token = $auth->exchangeToken($params);
```

If you want to use [HTTP Basic Authentication Flow](https://dev.bitly.com/v4/#section/HTTP-Basic-Authentication-Flow)
set `$bitlyusername` and `$bitlypassword` as first and second arguments of Auth class constructor respectively, and pass `$client_id` and 
`$client_secret` as an array to `basicAuthFlow()` method:

```php
use PHPLicengine\Service\Auth;
$params['client_id'] = "";
$params['client_secret'] = "";
$auth = new Auth($bitlyusername, $bitlypassword);
$token = $auth->basicAuthFlow($params);
```
