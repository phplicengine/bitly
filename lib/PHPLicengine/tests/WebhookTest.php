<?php

// WebhookTest.php
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

use PHPLicengine\Api\ApiInterface;
use PHPLicengine\Service\Webhook;
use PHPUnit\Framework\TestCase;

class WebhookTest extends TestCase
{
    
    public function testCreateWebhook()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('post')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/webhooks'),
                    $this->identicalTo(['key' => 'value'])
                    );
        $bitlink = new Webhook($mock);
        $bitlink->createWebhook(['key' => 'value']);
    } 

    public function testGetWebhooks()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/organizations/test/webhooks')
                  );
        $bitlink = new Webhook($mock);
        $bitlink->getWebhooks('test');
    } 

    public function testGetWebhook()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('get')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/webhooks/test')
                  );
        $bitlink = new Webhook($mock);
        $bitlink->getWebhook('test');
    } 

    public function testUpdateWebhook()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('patch')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/webhooks/test'),
                    $this->identicalTo(['key' => 'value'])

                  );
        $bitlink = new Webhook($mock);
        $bitlink->updateWebhook('test', ['key' => 'value']);
    } 

    public function testDeleteWebhook()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('delete')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/webhooks/test')
                  );
        $bitlink = new Webhook($mock);
        $bitlink->deleteWebhook('test');
    } 
    
    public function testVerifyWebhook()
    {
        $mock = $this->createMock(ApiInterface::class);
        $mock
            ->expects($this->once())
            ->method('post')
            ->with(
                    $this->equalTo('https://api-ssl.bitly.com/v4/webhooks/test/verify'));
        $bitlink = new Webhook($mock);
        $bitlink->verifyWebhook('test');
    } 
}
