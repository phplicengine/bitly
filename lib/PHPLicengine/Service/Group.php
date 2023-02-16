<?php

// Group.php
#################################################
##
## PHPLicengine
##
#################################################
## Copyright 2009-{current_year} PHPLicengine
## 
## Licensed under the Apache License, Version 2.0 (the "License");
## you may not use this file except in compliance with the License.
## You may obtain a copy of the License at
##
##    http://www.apache.org/licenses/LICENSE-2.0
##
## Unless required by applicable law or agreed to in writing, software
## distributed under the License is distributed on an "AS IS" BASIS,
## WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
## See the License for the specific language governing permissions and
## limitations under the License.
#################################################

namespace PHPLicengine\Service;
use PHPLicengine\Exception\ResponseException;
use PHPLicengine\Exception\CurlException;
use PHPLicengine\Api\ApiInterface;

class Group {
 
       private $url;
       private $api;      
      
       public function __construct(ApiInterface $api)
       {
              $this->api = $api;
              $this->url = 'https://api-ssl.bitly.com/v4/groups';       
       }
 
       /*
      Retrieve Tags by Group
      https://dev.bitly.com/api-reference#getGroupTags
      */
       public function getGroupTags(string $group_guid) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/tags');
       }
      
       /*
      Get Click Metrics for a Group by referring networks
      https://dev.bitly.com/api-reference#GetGroupMetricsByReferringNetworks
      */
       public function getGroupMetricsByReferringNetworks(string $group_guid) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/referring_networks');
       }
      
       /*
      Retrieve Group Shorten Counts
      https://dev.bitly.com/api-reference#getGroupShortenCounts
      */
       public function getGroupShortenCounts(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/shorten_counts', $params);
       }

       /*
      Retrieve Groups
      https://dev.bitly.com/api-reference#getGroups
      */
       public function getGroups(array $params = array()) 
       {
              return $this->api->get($this->url, $params);
       }
      
       /*
      Retrieve Group Preferences
      https://dev.bitly.com/api-reference#getGroupPreferences
      */
       public function getGroupPreferences(string $group_guid) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/preferences');
       }
      
       /*
      Update Group Preferences
      https://dev.bitly.com/api-reference#updateGroupPreferences
      */
       public function updateGroupPreferences(string $group_guid, array $params) 
       {
              return $this->api->patch($this->url.'/'.$group_guid.'/preferences', $params);
       }

       /*
      Retrieve Bitlinks by Group
      https://dev.bitly.com/api-reference#getBitlinksByGroup
      */
       public function getBitlinksByGroup(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/bitlinks', $params);
       }

       /*
      Get Click Metrics for a Group by countries
      https://dev.bitly.com/api-reference#getGroupMetricsByCountries
      */
       public function getGroupMetricsByCountries(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/countries', $params);
       }
      
       /*
      Retrieve Sorted Bitlinks for Group
      https://dev.bitly.com/api-reference#getSortedBitlinks
      */
       public function getSortedBitlinks(string $group_guid, array $params = array(), string $sort = 'clicks') 
       {
              return $this->api->get($this->url.'/'.$group_guid.'/bitlinks/'.$sort, $params);
       }

       /*
      Update a Group
      https://dev.bitly.com/api-reference#updateGroup
      */
       public function updateGroup(string $group_guid, array $params) 
       {
              return $this->api->patch($this->url.'/'.$group_guid, $params);
       }      
      
       /*
      Retrieve a Group
      https://dev.bitly.com/api-reference#getGroup
      */
       public function getGroup(string $group_guid) 
       {
              return $this->api->get($this->url.'/'.$group_guid);
       }      
      
       /*
      Get Click Metrics for a Group by City
      https://dev.bitly.com/api-reference#getGroupMetricsByCities
      */
       public function getGroupMetricsByCities(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid."/cities", $params);
       }      

       /*
      Get Click Metrics for a Group by Device Type
      https://dev.bitly.com/api-reference#getGroupMetricsByDevices
      */
       public function getGroupMetricsByDevices(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid."/devices", $params);
       }   

       /*
      Get clicks by group
      https://dev.bitly.com/api-reference#getGroupClicks
      */
       public function getGroupClicks(string $group_guid, array $params = array()) 
       {
              return $this->api->get($this->url.'/'.$group_guid."/clicks", $params);
       } 
 
       /*
      Retrieve QR Code Logo Images
      https://dev.bitly.com/api-reference/#getQRLogoImagesByGroup
      */
       public function getQRLogoImagesByGroup(string $group_guid) 
       {
              return $this->api->get($this->url.'/'.$group_guid."/qr/images");
       } 
}
