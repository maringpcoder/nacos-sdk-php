<?php

declare(strict_types=1);

/**
 * @desc If turn on auth system  nacos.core.auth.enabled=true
 * @author Tinywan(ShaoBo Wan)
 * @date 2021/9/28 13:36
 */

namespace Nacos\Traits;


trait AccessToken
{
    /**
     * @var null|string
     */
    private $accessToken;

    /**
     * @var int
     */
    private $expireTime = 0;

    /**
     * @desc: getAccessToken
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        if ($this->username === null || $this->password === null) {
            return null;
        }
        if (!$this->isExpired()) {
            return $this->accessToken;
        }
        $result = $this->login($this->username, $this->password);
        $this->accessToken = $result['accessToken'];
        $this->expireTime = $result['tokenTtl'] + time();
        return $this->accessToken;
    }

    /**
     * @desc: isExpired
     * @return bool
     */
    protected function isExpired(): bool
    {
        if (isset($this->accessToken) && $this->expireTime > time() + 60) {
            return false;
        }
        return true;
    }
}