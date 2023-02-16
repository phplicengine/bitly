<?php

// Api.php
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

namespace PHPLicengine\Api;
use PHPLicengine\Exception\CurlException;

class Api implements ApiInterface {

              protected $_api_key_var = 'Authorization: Bearer ';
              protected $_api_key;
              protected $_timeout = 30;
              protected $_verify_ssl = true;
              protected $_verify_host = 2;
              protected $curlErrno = false;
              protected $curlError = false;
              protected $curlProxy = false;
              protected $response;
              protected $request = array();
              protected $json = true;
              protected $accept;
              protected $curlInfo;
              protected $_curl_callback;

              public function __construct($api_key = "", $basic = "") 
              { 
                     if (!function_exists('curl_init')) 
                     { 
                         throw new CurlException("cURL is not available. This API wrapper cannot be used."); 
                     } 
                  
                     if (isset($api_key))
                     {
                         $this->setApiKey($api_key);
                     } 
                  
                     if ($basic === true) 
                     {
                         $this->_api_key_var = 'Authorization: Basic ';
                         $this->json = false;
                     }
              }

              public function setOAuth()
              {
                     $this->_api_key_var = '';
                     $this->json = false;
                     $this->accept = true;
              }
  
              public function enableJson() 
              {
                     $this->_api_key_var = 'Authorization: Bearer ';
                     $this->json = true;
              } 
           
              public function setApiKey($api_key) 
              { 
                     $this->_api_key = $api_key;
              } 

              public function enableSslVerification() 
              { 
                     $this->_verify_ssl = true; 
                     $this->_verify_host = 2; 
              } 
  
              public function disableSslVerification() 
              { 
                     $this->_verify_ssl = false; 
                     $this->_verify_host = 0; 
              } 

              public function setTimeout($timeout) 
              { 
                     $this->_timeout = $timeout; 
              } 

              public function setCurlProxy($proxy)  
              {  
                     $this->curlProxy = $proxy;  
              }  

              public function setCurlCallback($callback) 
              { 
                     $this->_curl_callback = $callback; 
              } 

              private function _call($url, $params = null, $headers = null, $method = "GET") 
              {
                     $ch = curl_init();
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_URL, $url);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_FOLLOWLOCATION, false);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_TIMEOUT, $this->_timeout);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_RETURNTRANSFER, true);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_SSL_VERIFYPEER, $this->_verify_ssl);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_SSL_VERIFYHOST, $this->_verify_host);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_HEADER, true);
                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLINFO_HEADER_OUT, true);
                     if ($this->curlProxy) {  
                         curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_PROXY, $this->curlProxy);  
                     }  
                     if ($this->_curl_callback) { 
                         call_user_func($this->_curl_callback, $ch, $params, $headers, $method); 
                     } 
                     switch (strtoupper($method)) { 
                             case 'PATCH':
                                          if (!empty($params)) {
                                              curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
                                              curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_POSTFIELDS, json_encode($params));
                                          } 
                            break;
                            case 'DELETE':
                                          curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                            break;
                            case 'POST':
                                          curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_POST, true);
                                          curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_POSTFIELDS, $params);
                            break;
                            case 'GET':
                                          curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_HTTPGET, true);
                                          curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_URL, $url);
                            break;
                     }

                     curl_setopt(/** @scrutinizer ignore-type */ $ch, CURLOPT_HTTPHEADER, $this->_createHeaders($headers));

                     $this->request['method'] = strtoupper($method);
                     $this->request['headers'] = $this->_createHeaders($headers);
                     $this->request['params'] = $params;

                     $this->response = curl_exec(/** @scrutinizer ignore-type */ $ch);
                
                     if (curl_errno(/** @scrutinizer ignore-type */ $ch)) {
                         $this->curlErrno = curl_errno(/** @scrutinizer ignore-type */ $ch);
                         $this->curlError = curl_error(/** @scrutinizer ignore-type */ $ch);
                         curl_close(/** @scrutinizer ignore-type */ $ch);
                         return;
                     }
                
                     $this->curlInfo = curl_getinfo(/** @scrutinizer ignore-type */ $ch);
                     curl_close(/** @scrutinizer ignore-type */ $ch);
                     return new Result($this->_getBody(), $this->_getHeaders(), $this->curlInfo);
              }
              
              private function _createHeaders($headers = null)
              {
                      $headers[] = $this->_api_key_var.$this->_api_key;
                      if ($this->json === true) {
                          $headers[] = 'Content-Type: application/json';
                      }
                      if ($this->accept === true) {
                          $headers[] = 'Accept: application/json';
                      }
                      return $headers;
              }
  
              private function _parseHeaders($raw_headers) 
              {
                     if (!function_exists('http_parse_headers')) {
                            $headers = array();
                            $key = '';
                            foreach (explode("\n", $raw_headers) as $i => $h) {
                                   $h = explode(':', $h, 2);
                                   if (isset($h[1])) {
                                          if (!isset($headers[$h[0]])) {
                                                 $headers[$h[0]] = trim($h[1]);
                                          } elseif (is_array($headers[$h[0]])) {
                                                 $headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])));
                                          } else {
                                                 $headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])));
                                          }
                                          $key = $h[0];
                                   } else { 
                                          if (substr($h[0], 0, 1) == "\t") {
                                                 $headers[$key] .= "\r\n\t".trim($h[0]);
                                          } elseif (!$key) {
                                                 $headers[0] = trim($h[0]);
                                          }
                                   }
                            }
                            return $headers;
                     } else {
                            return http_parse_headers($raw_headers);
                     } 
              }

              private function _getHeaders()
              {
                      return $this->_parseHeaders(substr($this->response, 0, $this->curlInfo['header_size']));
              }

              private function _getBody()
              {
                      return substr($this->response, $this->curlInfo['header_size']);
              }

              public function getResponse()
              {
                     return $this->response;      
              }

              public function getRequest()
              {
                     return $this->request;
              }
           
              public function get($url, $params = null, $headers = null)
              {
                     if (!empty($params)) {
                         $url .= '?'.http_build_query($params);
                     }
                     return $this->_call($url, $params, $headers, $method = "GET");      
              }
           
              public function post($url, $params = null, $headers = null)
              {
                     if ($this->json === true) {
                         $params = json_encode($params);
                     }                                       
                     return $this->_call($url, $params, $headers, $method = "POST");      
              }

              public function delete($url, $params = null, $headers = null) 
              {
                     return $this->_call($url, $params, $headers, $method = "DELETE");      
              }

              public function put($url, $params = null, $headers = null) 
              {
                     return $this->_call($url, $params, $headers, $method = "PUT");      
              }

              public function patch($url, $params = null, $headers = null) 
              {
                     return $this->_call($url, $params, $headers, $method = "PATCH");      
              }

              public function getCurlInfo()
              {
                     return $this->curlInfo;
              }

              public function isCurlError() 
              {
                     return (bool) $this->curlErrno;
              }

              public function getCurlErrno() 
              {
                     return $this->curlErrno;
              }

              public function getCurlError() 
              {
                     return $this->curlError;
              }
           
}
