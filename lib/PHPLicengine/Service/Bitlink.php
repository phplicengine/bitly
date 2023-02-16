<?php

// Bitlink.php
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

class Bitlink {
 
       private $url;
       private $api;      
      
       public function __construct(ApiInterface $api)
       {
              $this->api = $api;
              $this->url = 'https://api-ssl.bitly.com/v4';       
       }
      
       /*
      Get Metrics for a Bitlink by referrers by domain
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByReferrersByDomains
      */
       public function getMetricsForBitlinkByReferrersByDomains(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/referrers_by_domains', $params);
       }
      
       /*
      Get Metrics for a Bitlink by countries
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByCountries
      */             
       public function getMetricsForBitlinkByCountries(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/countries', $params);
       }

       /*
      Get Clicks for a Bitlink
      https://dev.bitly.com/api-reference#getClicksForBitlink
      */
       public function getClicksForBitlink(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/clicks', $params);
       }

       /*
      Expand a Bitlink
      https://dev.bitly.com/api-reference#expandBitlink
      */
       public function expandBitlink(array $params) 
       {
              return $this->api->post($this->url.'/expand', $params);
       }
      
       /*
      Get Metrics for a Bitlink by referrers
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByReferrers
      */
       public function getMetricsForBitlinkByReferrers(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/referrers', $params);
       }
      
       /*
      Create a Bitlink
      https://dev.bitly.com/api-reference#createFullBitlink
      */
       public function createFullBitlink(array $params) 
       {
              return $this->api->post($this->url.'/bitlinks', $params);
       }
      
       /*
      Update a Bitlink
      https://dev.bitly.com/api-reference#updateBitlink
      */
       public function updateBitlink(string $bitlink, array $params = array()) 
       {
              return $this->api->patch($this->url.'/bitlinks/'.$bitlink, $params);
       }

       /*
      Retrieve a Bitlink
      https://dev.bitly.com/api-reference#getBitlink
      */
       public function getBitlink(string $bitlink) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink);
       }

       /*
      Get Clicks Summary for a Bitlink
      https://dev.bitly.com/api-reference#getClicksSummaryForBitlink
      */
       public function getClicksSummaryForBitlink(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/clicks/summary', $params);
       }

       /*
      Shorten a Link
      https://dev.bitly.com/api-reference#createBitlink
      */
       public function createBitlink(array $params) 
       {
              return $this->api->post($this->url.'/shorten', $params);
       }

       /*
      Get Metrics for a Bitlink by referring domains
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByReferringDomains
      */
       public function getMetricsForBitlinkByReferringDomains(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/referring_domains', $params);
       }
 
       /*
      Get a QR Code
      https://dev.bitly.com/api-reference#getBitlinkQRCode
      */
       public function getBitlinkQRCode(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/qr', $params);
       }
 
       /*
      Get Metrics for a Bitlink by City
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByCities
      */
       public function getMetricsForBitlinkByCities(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/cities', $params);
       }

       /*
      Get Metrics for a Bitlink by Device Type
      https://dev.bitly.com/api-reference#getMetricsForBitlinkByDevices
      */
       public function getMetricsForBitlinkByDevices(string $bitlink, array $params = array()) 
       {
              return $this->api->get($this->url.'/bitlinks/'.$bitlink.'/devices', $params);
       }
 
       /*
      Bulk update bitlinks
      https://dev.bitly.com/api-reference#updateBitlinksByGroup
      */
       public function updateBitlinksByGroup(string $group_guid, array $params = array()) 
       {
              return $this->api->patch($this->url . '/groups/'.$group_guid.'/bitlinks', $params);
       }
 
       /*
      Delete a Bitlink
      https://dev.bitly.com/api-reference/#deleteBitlink
      */
       public function deleteBitlink(string $bitlink) 
       {
               return $this->api->delete($this->url.'/bitlinks/'.$bitlink);
       }
      
      /*
      Create a QR Code
      https://dev.bitly.com/api-reference/#createBitlinkQRCode
      */
       public function createBitlinkQRCode(string $bitlink, array $params = array()) 
       {
              return $this->api->post($this->url.'/bitlinks/'.$bitlink.'/qr', $params);
       }
 
      /*
      Update a QR Code
      https://dev.bitly.com/api-reference/#updateBitlinkQRCode
      */
       public function updateBitlinkQRCode(string $bitlink, array $params = array()) 
       {
              return $this->api->patch($this->url.'/bitlinks/'.$bitlink.'/qr', $params);
       }
}
