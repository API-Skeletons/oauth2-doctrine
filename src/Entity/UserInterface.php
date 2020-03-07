<?php

/**
 * Because the user is decoupled from the OAuth2 Client entity
 * this interface serves for what OAuth2 needs from the User
 */

namespace ApiSkeletons\OAuth2\Doctrine\Entity;

/**
 * UserInterface
 */
interface UserInterface
{
    public function getClient();
    public function getAccessToken();
    public function getAuthorizationCode();
    public function getRefreshToken();
}
