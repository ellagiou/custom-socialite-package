<?php

namespace Ellagiou\CustomSocialitePackage;

use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class CustomSocialitePackageProvider extends AbstractProvider
{
    /**
    * @return string
    */
    public function getBaseAuthUrl():string
    {
        /**
         * This url is fromm oauth provider
         */
        return 'http://localhost:8000/oauth2';
    }

    /**
    * @param string $state
    *
    * @return string
    */
    public function getAuthUrl($state): string
    {
    return $this->buildAuthUrlFromBase($this->getBaseAuthUrl(), $state);
    }
 
    protected function getTokenUrl()
    {
        /**
         * Get token for the user 
         */
        return $this->getBaseAuthUrl() . '/token';
    }

 
    protected function getUserByToken($token)
    {
    $response = $this->getHttpClient()->post($this->getBaseAuthUrl() . '/userInfo', [
        'headers' => [
            'cache-control' => 'no-cache',
            'Authorization' => 'Bearer ' . $token,
            'Content-Type' => 'application/x-www-form-urlencoded',
        ],
    ]);
 
    return json_decode($response->getBody()->getContents(), true);
    }
 
    /**
    * @return User
    */
    protected function mapUserToObject(array $user)
    {
       return (new User())->setRaw($user)->map([
        'id' => $user['sub'],
        'email' => $user['email'],
        'username' => $user['username'],
        'email_verified' => $user['email_verified'],
        'family_name' => $user['family_name'],
       ]);
    }
    }
