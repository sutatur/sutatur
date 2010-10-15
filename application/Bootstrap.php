<?php
require_once 'Zend/Application/Bootstrap/Bootstrap.php';
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initViewHelpers ()
    {
        // bootstrap the layout and get the view object 
        $this->bootstrap(
        'layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        // setup helpers
        $view->headMeta()->appendHttpEquiv(
        'Content-Type', 
        'text/html; charset=utf-8');
        $view->headTitle(
        '.:: 100% Turism ::.');
        $view->doctype('XHTML1_STRICT');
        $view->headLink()->appendStylesheet(
        Zend_Controller_Front::getInstance()->getBaseUrl() .
         '/styles/default.css');
    }


    /**
     * Initialize module resources
     *
     * @return mixed registry items
     */
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Front_',
            'basePath'  => dirname(__FILE__),
        ));

        // Add resource type for Module Api
        //$autoloader->add
        $autoloader->addResourceType('api','api/','Api');
        // Zend_debug::dump($autoloader->getResourceTypes());
        return $autoloader;
    }
    
    protected function _initRegistry()
    {
        $this->bootstrap(array('Entitymanagerfactory','log'));
        Zend_Registry::set('em',$this->getResource('Entitymanagerfactory'));
        Zend_Registry::set('logger',$this->getResource('log'));
    }
}