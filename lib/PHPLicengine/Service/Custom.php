<?php

// Custom.php
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

class Custom extends \PHPLicengine\Api\Api {
 
      private $url;
      
      public function __construct ($api_key)
      {
             parent::__construct($api_key);
             $this->url = 'https://api-ssl.bitly.com/v4/custom_bitlinks';       

      }
 
      /*
      Update Custom Bitlink
      https://dev.bitly.com/v4/#operation/updateCustomBitlink
      */
      public function updateCustomBitlink(string $custom_bitlink, array $params)
      {
             return $this->patch($this->url . '/'.$custom_bitlink, $params);
      }

      /*
      Retrieve Custom Bitlink
      https://dev.bitly.com/v4/#operation/getCustomBitlink
      */
      public function getCustomBitlink(string $custom_bitlink)
      {
             return $this->get($this->url . '/'.$custom_bitlink);
      }
      
      /*
      Add Custom Bitlink
      https://dev.bitly.com/v4/#operation/addCustomBitlink
      */
      public function addCustomBitlink(array $params)
      {
             return $this->post($this->url, $params);
      }
      
      /*
      Get Metrics for a Custom Bitlink by destination
      https://dev.bitly.com/v4/#operation/getCustomBitlinkMetricsByDestination
      */
      public function getCustomBitlinkMetricsByDestination(string $custom_bitlink)
      {
             return $this->get($this->url . '/'.$custom_bitlink.'/clicks_by_destination');
      }
      
}
