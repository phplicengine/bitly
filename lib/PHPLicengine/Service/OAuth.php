<?php

// OAuth.php
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

class OAuth {
 
       private $url;
       private $api;
 
       public function __construct(ApiInterface $api)
       {
              $this->api = $api;
              $this->url = 'https://api-ssl.bitly.com';       
       }
 
       /*
       Retrieve OAuth App
       https://dev.bitly.com/v4/#operation/getOAuthApp
       */
       public function getOAuthApp(string $client_id) 
       {
              return $this->api->get($this->url.'/v4/apps/'.$client_id);
       }

       /*
       OAuth web flow
       https://dev.bitly.com/docs/getting-started/authentication
       */
       public function getOAuthToken(array $params) 
       {
              $this->api->setOAuth();
              return $this->api->post($this->url.'/oauth/access_token', $params);
       }
      
}
