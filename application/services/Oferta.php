<?php
/**
 * @throws Application_Service_Exception
 * @author angel
 *
 */
use Doctrine\ORM;
use \Doctrine\ORM\ORMException;

require_once 'Abstract.php';
class Application_Service_Oferta extends Application_Service_Abstract implements Zend_Acl_Resource_Interface
{
    const MODEL_CLASS_SEJUR = 'Application_Model_Sejur';
    const MODEL_CLASS_CIRCUIT = 'Application_Model_Circuit';
    
    const MODEL_FORM_SEJUR = 'OfertaSejur';
    const MODEL_FORM_CIRCUIT = 'Circuit';
    
    /**
     * @var Zend_Authentication
     */
    private $auth;
    
    /**
     * @var string
     */
    private $ofertaTip;
    
    function __construct($ofertaTip = null)
    {
        $this->ofertaTip = $ofertaTip;
        
        if ($ofertaTip == 'circuit' )
        {
            $modelClass =  self::MODEL_CLASS_CIRCUIT; 
            $modelForm = self::MODEL_FORM_CIRCUIT;
        }
        else
        {
            $modelClass = self::MODEL_CLASS_SEJUR;
            $modelForm =  self::MODEL_FORM_SEJUR;
        }
        
        parent::__construct();
        
        $this->modelClass = $modelClass;
        $this->modelForm = $modelForm;
    }
    
    
	/**
     * @return the $ofertaTip
     */
    public function getOfertaTip ()
    {
        return $this->ofertaTip;
    }

	/**
     * @param $ofertaTip the $ofertaTip to set
     */
    public function setOfertaTip ($ofertaTip)
    {
        $this->ofertaTip = $ofertaTip;
    }
	/**
     * @return the $model
     */
    public function getModel ()
    {
        return $this->modelClass;
    }
    
    
    public function getOferteByOperator(id)
    {
        $this->repository->get
    }
   
    
    public function getResourceId()
    {
        return 'oferta';
    }
}
?>