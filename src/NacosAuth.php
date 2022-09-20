<?php

declare(strict_types=1);

namespace Nacos;

use Nacos\Exceptions\NacosConnectionException;
use Nacos\Traits\AccessToken;

class NacosAuth
{
    use AccessToken;

    /**
     * @var NacosClient
     */
    protected $client;
    /**
     * @var $username ,用户名
     */
    private $username;

    /**
     * @var $password,密码
     */
    private $password;

    /**
     * @param NacosClient $client
     */
    public function __construct(NacosClient $client)
    {
        $this->client = $client;
    }

    /**
     * @desc: login
     * @param string $username
     * @param string $password
     */
    public function login(string $username, string $password)
    {
        $res = $this->client->login($username, $password);
        $content = json_decode($res,true);
        if (isset($content["accessToken"])){
            $this->username=$username;
            $this->password=$password;
            $this->accessToken = $content['accessToken'];
            $this->expireTime = $content['tokenTtl'];
            return $content;
        }else{
            throw new NacosConnectionException();
        }

    }
}
