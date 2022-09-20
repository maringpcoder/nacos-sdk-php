<?php


namespace Nacos\Tests;


use Nacos\NacosAuth;
use Nacos\NacosClient;

class NacosClientWithAuthTest extends TestCase
{
   public function testGetConfig()
   {
       $client = new NacosClient('127.0.0.1', 8848);
       $auth = new NacosAuth($client);
       $auth->login('nacos','nacos');
       $client->setNamespace("01ae5458-c846-4440-88f4-ec0106c88f82");
       var_dump($auth->getAccessToken());
       $config = $client->getConfig("micro-service-conf", "dev", ["accessToken" => $auth->getAccessToken()]);
       var_dump($config);
   }
}