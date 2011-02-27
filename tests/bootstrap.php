<?php
 
error_reporting( E_ALL | E_STRICT );
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
 
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

defined ('MODULE_PATH')
    || define ('MODULE_PATH', APPLICATION_PATH .'/modules/');

    
define('APPLICATION_ENV', 'testing');
define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/../library'));
define('TESTS_PATH', realpath(dirname(__FILE__)));
 
$_SERVER['SERVER_NAME'] = 'http://z100Turism';
 
$includePaths = array(LIBRARY_PATH, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $includePaths));

require_once "Zend/Loader/Autoloader.php";
#Zend_Loader::registerAutoload();
$loader = Zend_Loader_Autoloader::getInstance();
$loader->setFallbackAutoloader(true);
$loader->suppressNotFoundWarnings(false);
 
 
Zend_Session::$_unitTestEnabled = true;
Zend_Session::start();
 
//$application = new Zend_Application(
//   APPLICATION_ENV,
//   APPLICATION_PATH . '/configs/application.ini'
//);
//
//$application->bootstrap();
clearstatcache();