<?php

namespace ApiSkeletons\OAuth2\Doctrine\Mapper;

use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use DoctrineModule\Persistence\ProvidesObjectManager as ProvidesObjectManagerTrait;
use Laminas\Config\Config;
use Laminas\ServiceManager\Exception;

class MapperManager implements
    ObjectManagerAwareInterface
{
    use ProvidesObjectManagerTrait;

    /**
     * @var Config
     */
    protected $config;
    /**
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * Default set of plugins
     *
     * @var array
     */
    protected $invokableClasses = [
        'user' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\User',
        'client' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\Client',
        'accesstoken' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\AccessToken',
        'refreshtoken' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\RefreshToken',
        'authorizationcode' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\AuthorizationCode',
        'jwt' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\Jwt',
        'jti' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\Jti',
        'scope' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\Scope',
        'publickey' => 'ApiSkeletons\OAuth2\Doctrine\Mapper\PublicKey',
    ];

    /**
     * @param Config $config
     * @return $this
     */
    public function setConfig(Config $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param string $name
     * @param array $options
     * @param bool $usePeeringServiceManagers
     * @return AbstractMapper
     */
    public function get($name, $options = [], $usePeeringServiceManagers = true)
    {
        /** @var AbstractMapper $instance */
        $instance = new $this->invokableClasses[strtolower($name)];
        $instance->setConfig($this->getConfig()->$name);
        $instance->setObjectManager($this->getObjectManager());
        $instance->setMapperManager($this);

        return $instance;
    }

    public function getAll()
    {
        $resources = [];
        foreach ($this->getConfig() as $resourceName => $config) {
            $resources[] = $this->get($resourceName);
        }

        return $resources;
    }

    /**
     * @param mixed $command
     *
     * @return void
     * @throws Exception\InvalidServiceException
     */
    public function validatePlugin($command)
    {
        if ($command instanceof AbstractMapper) {
            // we're okay
            return;
        }

        // @codeCoverageIgnoreStart
        throw new Exception\InvalidServiceException(sprintf(
            'Plugin of type %s is invalid; must implement ApiSkeletons\OAuth2\Doctrine\Mapper\AbstractMapper',
            (is_object($command) ? get_class($command) : gettype($command))
        ));
        // @codeCoverageIgnoreEnd
    }
}
