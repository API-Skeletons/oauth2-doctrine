<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ApiSkeletons\OAuth2\Doctrine\Adapter;

use ApiSkeletons\OAuth2\Doctrine\Mapper\MapperManager;
use Doctrine\Common\Persistence\ObjectManager;
use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use InvalidArgumentException;
use Laminas\Config\Config;
use Laminas\ServiceManager\Exception\ServiceNotCreatedException;
use Laminas\ServiceManager\Exception\ServiceNotFoundException;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class DoctrineAdapterFactory implements FactoryInterface
{
    /**
     * @var Config
     */
    private $config;

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
     * @param ServiceLocatorInterface $services
     * @throws \Laminas\ApiTools\OAuth2\Controller\Exception\RuntimeException
     * @return \Laminas\ApiTools\OAuth2\Doctrine\Adapter\DoctrineAdapter
     */
    public function createService(ServiceLocatorInterface $services)
    {
        return $this->create($services);
    }

    /**
     * @param ContainerInterface | ServiceLocatorInterface $services
     * @param string $objectManagerAlias
     *
     * @return ObjectManager
     * @throws \Laminas\ServiceManager\Exception\ServiceNotCreatedException
     * @throws InvalidArgumentException
     */
    protected function loadObjectManager($services, $objectManagerAlias)
    {
        if (! $services instanceof ContainerInterface && ! $services instanceof ServiceLocatorInterface) {
            throw new InvalidArgumentException('Invalid container');
        }

        if ($services->has($objectManagerAlias)) {
            $objectManager = $services->get($objectManagerAlias);
        } else {
            // @codeCoverageIgnoreStart
            throw new ServiceNotCreatedException('The object_manager ' . $objectManagerAlias . ' could not be found.');
        }
        // @codeCoverageIgnoreEnd

        return $objectManager;
    }

    /**
     * @param ContainerInterface | ServiceLocatorInterface $services
     * @param Config $config
     *
     * @return MapperManager
     * @throws \Laminas\ServiceManager\Exception\ServiceNotCreatedException
     * @throws InvalidArgumentException
     */
    protected function loadMapperManager($services, Config $config)
    {
        if (! $services instanceof ContainerInterface && ! $services instanceof ServiceLocatorInterface) {
            throw new InvalidArgumentException('Invalid container');
        }

        if ($services->has('ApiSkeletons\OAuth2\Doctrine\Mapper\MapperManager')) {
            $mapperManager = new MapperManager($services);
        } else {
            // @codeCoverageIgnoreStart
            throw new ServiceNotCreatedException(
                'The MapperManager ApiSkeletons\OAuth2\Doctrine\Mapper\MapperManager could not be found.'
            );
        }
        // @codeCoverageIgnoreEnd

        $mapperManager->setConfig($config->mapping);
        $mapperManager->setObjectManager($this->loadObjectManager($services, $config->object_manager));

        return $mapperManager;
    }

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return DoctrineAdapter
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws InvalidArgumentException
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->create($container);
    }

    /**
     * @param ContainerInterface | ServiceLocatorInterface $container
     * @return DoctrineAdapter
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws InvalidArgumentException
     */
    protected function create($container)
    {
        if (! $container instanceof ContainerInterface && ! $container instanceof ServiceLocatorInterface) {
            throw new InvalidArgumentException('Invalid container');
        }

        $adapter = $container->get('ApiSkeletons\OAuth2\Doctrine\Adapter\DoctrineAdapter');

        $adapter->setConfig($this->config);
        $adapter->setObjectManager($this->loadObjectManager($container, $this->config->object_manager));
        $adapter->setMapperManager($this->loadMapperManager($container, $this->config));

        return $adapter;
    }
}
