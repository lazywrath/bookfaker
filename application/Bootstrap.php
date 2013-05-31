<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoloader()
    {
        $loader = function($className) {
            $className = str_replace('\\', '_', $className);
            Zend_Loader_Autoloader::autoload($className);
        };

        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->pushAutoloader($loader, 'Application\\');
    }
    
    protected function _initDoctrine()
    {
        $this->bootstrap('autoloader');

        require_once('Doctrine/Common/ClassLoader.php');

        // Create the doctrine autoloader and remove it from the spl autoload stack (it adds itself)
        require_once 'Doctrine/Common/ClassLoader.php';
        $doctrineAutoloader = array(new \Doctrine\Common\ClassLoader(), 'loadClass');
        //$doctrineAutoloader->register();
        spl_autoload_unregister($doctrineAutoloader);

        $autoloader = Zend_Loader_Autoloader::getInstance();

        // Push the doctrine autoloader to load for the Doctrine\ namespace
        $autoloader->pushAutoloader($doctrineAutoloader, array('Doctrine', 'Symfony'));

        $classLoader = new \Doctrine\Common\ClassLoader('Entities', realpath(APPLICATION_PATH. '/models/entities'), 'loadClass');
        $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Entities');

        $classLoader = new \Doctrine\Common\ClassLoader('Symfony', realpath(APPLICATION_PATH. '/../library/Doctrine/'), 'loadClass');
        $autoloader->pushAutoloader(array($classLoader, 'loadClass'), 'Symfony');

        $doctrineConfig = $this->getOption('doctrine');
        $config = new \Doctrine\ORM\Configuration();

        $cache = new \Doctrine\Common\Cache\ArrayCache;
        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);
        
        // Define path to your entities and proxies.
        $entityPath = APPLICATION_PATH.'/models/entities';
        $proxyPath    = APPLICATION_PATH.'/models/proxies';

        $driverImpl = $config->newDefaultAnnotationDriver($entityPath);
        $config->setMetadataDriverImpl($driverImpl);

        $config->setProxyDir($proxyPath);
        $config->setProxyNamespace("Proxies");

        $connectionOptions = array(
            'driver' => $doctrineConfig['conn']['driver'],
            'user' => $doctrineConfig['conn']['user'],
            'password' => $doctrineConfig['conn']['pass'],
            'dbname' => $doctrineConfig['conn']['dbname'],
            'host' => $doctrineConfig['conn']['host']
        );
        
        // Get the entity manager.
        $em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

        $registry = Zend_Registry::getInstance();
        $registry->entityManager = $em;

        return $em;
    }
}

