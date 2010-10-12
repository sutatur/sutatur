<?php
abstract class Application_Service_Abstract
{
    /**
     * 
     * @var Zend_Auth_Role
     */
    protected $_identity;
    /**
     * Acl 
     * @var Zend_Acl
     */
    protected $_acl;
    
    /**
     * Array of forms
     * @param array $forms;
     */
    protected $forms;

    /**
     * @var Application_Model_Oferta
     */
    protected $modelClass;
    
    /**
     * @var Zend_Log
     */
    private $logger;
    
    /** 
     * @var Array
     */
    private $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected  $dao;
    
    const MODEL_CLASS = '';
    
    /**
     * Returns a form object
     * @return Zend_Form
     * @param string $type
     */
    public function getForm($type)
    {
        $type  = ucfirst($type);
        if (!isset($this->forms[$type])) {
            $class = 'Application_Form_' . $type;
            $this->forms[$type] = new $class;
        }
        return $this->forms[$type];
    }    
    
    public function setIdentity ($identity)
    {
        if (is_array($identity))
            {
            if (!isset($identity['role'])) {
                $identity['role'] = 'guest';
            }
            $identity = new Zend_Acl_Role($identity['role']);
        } elseif (is_scalar($identity) && !is_bool($identity)) {
            $identity = new Zend_Acl_Role($identity);
        } elseif (null === $identity) {
            $identity = new Zend_Acl_Role('guest');
        } elseif (!$identity instanceof  Zend_Acl_Role_Interface)
        {
            throw new Application_Service_Exception('Invalid identity provided');
        }
        $this->_identity = $identity;
        return $this;
    }
    public function getIdentity ()
    {
        if (null === $this->_identity) {
            $auth = Zend_Auth::getInstance();
            if (! $auth->hasIdentity()) {
                return 'guest';
            }
            $this->setIdentity(
            $auth->getIdentity());
        }
        return $this->_identity;
    }
    
    public function setAcl($acl)
    {
        $this->_acl = $acl;
    }

    public function getAcl()
    {
        if (null === $this->_acl) {
            $this->setAcl(new Application_Model_Acl_Sutatur());
        }
        return $this->_acl;
    }    
    

    public function checkAcl($action)
    {
        return $this->getAcl()->isAllowed(
            $this->getIdentity(), 
            $this, 
            $action
        );
    }

    public function __construct()
    {
        $this->logger = Zend_Registry::get('logger');
        $this->dao = Zend_Registry::get('em');
        
        $childClass = get_class($this);
        $this->modelClass = $childClass::MODEL_CLASS;
    }
}
?>