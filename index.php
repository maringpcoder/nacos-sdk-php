<?php

use Nacos\NacosAuth;
use Nacos\NacosClient;

$client = new NacosClient('127.0.0.1', 8848);
$auth = new NacosAuth($client);
$auth->login('nacos','nacos');
var_dump($auth->getAccessToken());
//