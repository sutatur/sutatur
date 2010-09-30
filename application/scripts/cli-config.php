<?php
require_once 'Doctrine/Common/ClassLoader.php';

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../'));


// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));
// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library/'),
    get_include_path(),
)));

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);


$classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
$classLoader->register();

$classLoader = new \Doctrine\Common\ClassLoader('Symfony', 'Doctrine');
$classLoader->register();


$pl = $application->getBootstrap()->getPluginLoader();

// don't need for this anymore; pluginpaths in application.ini takes care of this
//$pl->addPrefixPath('ZendX_Doctrine2_Application_Resource','ZendX/Doctrine2/Application/Resource');

$pl->load('Entitymanagerfactory');



$em = $application->getBootstrap()->getPluginResource('entitymanagerfactory');
$em2 = $em->init();
	//	$em2 = $application->getBootstrap()->getPluginResourceNames();
	//	var_dump($em);

$helpers = array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em2->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em2, APPLICATION_PATH . '/models')
);