<?php

namespace Nocks\SDK\Api;

/**
 * Class Merchant
 * @package Nocks\SDK\Api
 */
class User extends Api
{
    /**
     * @param $user
     * @return \Nocks\SDK\Connection\Response
     */
    public function create($user)
    {
        $result = $this->client->post('user', null, $user);

        return json_decode($result->body(), true);
    }
}