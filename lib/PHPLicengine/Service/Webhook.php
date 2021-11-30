<?php

// Webhook.php
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

class Webhook {
 
      private $url;
      private $api;      
      
      public function __construct(ApiInterface $api)
      {
             $this->api = $api;
             $this->url = 'https://api-ssl.bitly.com/v4/webhooks';       
      }
 
      /*
      Create Webhook
      https://dev.bitly.com/api-reference#createWebhook
      */
      public function createWebhook(array $params) 
      {
             return $this->api->post($this->url, $params);
      }

      /*
      Get Webhooks
      https://dev.bitly.com/api-reference#getWebhooks
      */
      public function getWebhooks(string $organization_guid) 
      {
             return $this->api->get("https://api-ssl.bitly.com/v4/organizations/".$organization_guid."/webhooks");
      }
      
      /*
      Retrieve Webhook
      https://dev.bitly.com/api-reference#getWebhook
      */
      public function getWebhook(string $webhook_guid) 
      {
             return $this->api->get($this->url."/".$webhook_guid);
      }      

      /*
      Update Webhook
      https://dev.bitly.com/api-reference#updateWebhook
      */
      public function updateWebhook(string $webhook_guid, array $params) 
      {
             return $this->api->patch($this->url."/".$webhook_guid, $params);
      }      

      /*
      Delete Webhook
      https://dev.bitly.com/api-reference#deleteWebhook
      */
      public function deleteWebhook(string $webhook_guid) 
      {
             return $this->api->delete($this->url."/".$webhook_guid);
      }      

       /*
      Verify Webhook
      https://dev.bitly.com/api-reference#verifyWebhook
      */
      public function verifyWebhook(string $webhook_guid) 
      {
             return $this->api->post($this->url."/".$webhook_guid."/verify");
      }
 
}
