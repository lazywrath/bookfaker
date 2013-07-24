<?php

// Define path to your entities and proxies.
$entityPath = '../../models/entities';
$proxyPath    = '../../models/proxies';
 
// Register the namespace and include path of your entities to autoloader.
require '../../library/Doctrine/Common/ClassLoader.php';

use Doctrine\Common\ClassLoader;

$classLoader = new ClassLoader('Entities', $entityPath);
$classLoader->register();
 
// Register the namespace and include path of your proxies to autoloader.
$classLoader = new ClassLoader('Proxies', $proxyPath);
$classLoader->register();

// Setup the configuration.
$config = new \Doctrine\ORM\Configuration();
$driverImpl = $config->newDefaultAnnotationDriver($entityPath);
$config->setMetadataDriverImpl($driverImpl);
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$config->setProxyDir($proxyPath);
$config->setProxyNamespace('models\proxies');
 
// Specify the connection options to your database.
$connectionOptions = array(
    'driver'    => 'pdo_mysql',
    'user'        => 'root',
    'pass'        => '',
    'dbname'    => 'test',
    'host'        => 'localhost'
);
 
// Get the entity manager.
$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);
 
$helperSet = new \Symfony\Components\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));
?>
