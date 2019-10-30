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

class Bitlink extends \PHPLicengine\Api\Api {
 
      private $url;
      
      public function __construct ($api_key)
      {
             parent::__construct($api_key);
             $this->url = 'https://api-ssl.bitly.com/v4';       

      }
      
      /*
      Get Metrics for a Bitlink by referrers by domain
      https://dev.bitly.com/v4/#operation/getMetricsForBitlinkByReferrersByDomains
      */
      public function getMetricsForBitlinkByReferrersByDomains(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/referrers_by_domains');
      }
      
      /*
      Get Metrics for a Bitlink by countries
      https://dev.bitly.com/v4/#operation/getMetricsForBitlinkByCountries
      */             
      public function getMetricsForBitlinkByCountries(string $bitlink, array $params) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/countries', $params);
      }

      /*
      Get Clicks for a Bitlink
      https://dev.bitly.com/v4/#operation/getClicksForBitlink
      */
      public function getClicksForBitlink(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/clicks');
      }

      /*
      Expand a Bitlink
      https://dev.bitly.com/v4/#operation/expandBitlink
      */
      public function expandBitlink(array $params) 
      {
             return $this->post($this->url . '/expand', $params);
      }
      
      /*
      Get Metrics for a Bitlink by referrers
      https://dev.bitly.com/v4/#operation/getMetricsForBitlinkByReferrers
      */
      public function getMetricsForBitlinkByReferrers(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/referrers');
      }
      
      /*
      Create a Bitlink
      https://dev.bitly.com/v4/#operation/createFullBitlink
      */
      public function createFullBitlink(array $params) 
      {
             return $this->post($this->url . '/bitlinks', $params);
      }
      
      /*
      Update a Bitlink
      https://dev.bitly.com/v4/#operation/updateBitlink
      */
      public function updateBitlink(string $bitlink, array $params) 
      {
             return $this->patch($this->url . '/bitlinks/'.$bitlink, $params);
      }

      /*
      Retrieve a Bitlink
      https://dev.bitly.com/v4/#operation/getBitlink
      */
      public function getBitlink(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink);
      }

      /*
      Get Clicks Summary for a Bitlink
      https://dev.bitly.com/v4/#operation/getClicksSummaryForBitlink
      */
      public function getClicksSummaryForBitlink(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/clicks/summary');
      }

      /*
      Shorten a Link
      https://dev.bitly.com/v4/#operation/createBitlink
      */
      public function createBitlink(array $params) 
      {
             return $this->post($this->url . '/shorten', $params);
      }

      /*
      Get Metrics for a Bitlink by referring domains
      https://dev.bitly.com/v4/#operation/getMetricsForBitlinkByReferringDomains
      */
      public function getMetricsForBitlinkByReferringDomains(string $bitlink) 
      {
             return $this->get($this->url . '/bitlinks/'.$bitlink.'/referring_domains');
      }
      
      /*
      Retrieve Bitlinks by Group
      https://dev.bitly.com/v4/#operation/getBitlinksByGroup
      */
      public function getBitlinksByGroup(string $group_guid) 
      {
             return $this->get($this->url . '/groups/'.$group_guid.'/bitlinks');
      }


      /*
      Get Click Metrics for a Group by countries
      https://dev.bitly.com/v4/#operation/getGroupMetricsByCountries
      */
      public function getGroupMetricsByCountries(string $group_guid) 
      {
             return $this->get($this->url . '/groups/'.$group_guid.'/countries');
      }

}
