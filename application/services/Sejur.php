<?php
/**
 * @throws Application_Service_Exception
 * @author angel
 *
 */
abstract class Applicaton_Service_Circuit
{
    const MODEL_SEJUR = 'Application_Model_Sejur';
    const MODEL_CIRCUIT = 'Application_Model_Circuit';
    
    /**
     * @var Zend_Authentication
     */
    private $auth;
    
    /**
     * @var Application_Model_Oferta
     */
    private $model;
    
    /**
     * @var Zend_Logger
     */
    private $logger;
    
    /** 
     * @var Array
     */
    private $data;
    
    /**
     * @var Array
     */
    private $requiredData;
    
    function __construct($ofertaTip = null)
    {
        $this->auth = Zend_Auth::getInstance();
        
        if (is_null($ofertaTip))
            throw new Application_Service_Exception('Tipul ofertei nu a fost specificat');
        
        $ofertaTip == 'circuit' ? $this->model = self::MODEL_CIRCUIT : self::MODEL_SEJUR;
        
        $this->logger = Zend_Registry::get('logger');
    }
    
    
    private function hasRights($action)
    {
        return $this->auth->hasIdentity();
    }
    
    private function _isDataValid() 
    {
        $requiredData = array();
    }
}
?>