<?php

namespace ApiSkeletons\OAuth2\Doctrine\ClientAssertionType;

use OAuth2\RequestInterface;
use OAuth2\ResponseInterface;
use OAuth2\ClientAssertionType\ClientAssertionTypeInterface;
use Laminas\Stdlib\ArraySerializableInterface;
use ArrayAccess;

/**
 * Interface for all OAuth2 Client Assertion Types
 */
class AuthorizationCode implements
    ArrayAccess,
    ArraySerializableInterface,
    ClientAssertionTypeInterface
{
    public function offsetSet($offset, $value): void
    {
        // @codeCoverageIgnoreStart
        $this->$offset = $value;
    }
        // CodeCoverageIgnoreEnd

    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }

    public function offsetUnset($offset): void
    {
        // @codeCoverageIgnoreStart
        throw new \Exception('not implemented');
    }
        // @codeCoverageIgnoreEnd

    public function offsetGet($offset): mixed
    {
        return isset($this->$offset) ? $this->$offset : null;
    }

    public $authorization_code;

    public $redirect_uri;

    public $expires;

    public $scope;

    public $id_token;

    public $client_id;

    public $user_id;

    public function getAuthorizationCode()
    {
        return $this->authorization_code;
    }

    public function setAuthorizationCode($value)
    {
        $this->authorization_code = $value;

        return $this;
    }

    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    public function setRedirectUri($value)
    {
        $this->redirect_uri = $value;

        return $this;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function setExpires($value)
    {
        $this->expires = $value;

        return $this;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function setScope($value)
    {
        $this->scope = $value;

        return $this;
    }

    public function getIdToken()
    {
        return $this->id_token;
    }

    public function setIdToken($value)
    {
        $this->id_token = $value;

        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($value)
    {
        $this->user_id = $value;

        return $this;
    }

    public function getClientId()
    {
        return $this->client_id;
    }

    public function setClientId($value)
    {
        $this->client_id = $value;

        return $this;
    }

    public function getArrayCopy()
    {
        return [
            'authorization_code' => $this->getAuthorizationCode(),
            'redirect_uri' => $this->getRedirectUri(),
            'expires' => $this->getExpires(),
            'scope' => $this->getScope(),
            'id_token' => $this->getIdToken(),
            'client_id' => $this->getClientId(),
            'user_id' => $this->getUserId(),
        ];
    }

    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            $key = strtolower($key);
            $key = str_replace('_', '', $key);
            switch ($key) {
                case 'authorizationcode':
                    $this->setAuthorizationCode($value);
                    break;
                case 'redirecturi':
                    $this->setRedirectUri($value);
                    break;
                case 'expires':
                    $this->setExpires($value);
                    break;
                case 'scope':
                    $this->setScope($value);
                    break;
                case 'idtoken':
                    $this->setIdToken($value);
                    break;
                case 'clientid':
                    $this->setClientId($value);
                    break;
                case 'userid':
                    $this->setUserId($value);
                    break;
            // @codeCoverageIgnoreStart
                default:
                    break;
            }
            // @codeCoverageIgnoreEnd
        }

        return $this;
    }

    public function validateRequest(RequestInterface $request, ResponseInterface $response)
    {
        // @codeCoverageIgnoreStart
        throw new \Exception('Not implemented');
    }
        // @codeCoverageIgnoreEnd
}
