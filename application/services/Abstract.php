<?php
use sutaturism\models\Application_Model_Repository;
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
     * Form used to validate input data
     * @var Zend_Form
     */
    protected $modelForm;
    
    /**
     * @var Zend_Log
     */
    protected $logger;
    
    /** 
     * @var Array
     */
    protected $data;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private  $repository;
    
    const MODEL_CLASS = '';
    const MODEL_FORM = '';

    public function __construct(Application_Model_Repository $repository)
    {
        $this->logger = Zend_Registry::get('logger');
        $this->repository = Zend_Registry::get('em');
        
        $childClass = get_class($this);
        $this->modelClass = $childClass::MODEL_CLASS;
        $this->modelForm =  $childClass::MODEL_FORM;
        
        $this->repository = $repository;
    }
    
    
	/**
     * @param $data the $data to set
     */
    public function setData ($data)
    {
        $this->data = $data;
    }

    public function getData ()
    {
        return $this->data;
    }     
    
    public function save($data)
    {
        if ($this->checkAcl('save'))
            throw new Application_Service_Exception('Drepturi insuficiente');

        if (count($data) < 1)
            throw new Application_Service_Exception('Nici o data transmisa spre a fi salvata');
            
        /** @var $form Zend_Form */    
        $form = $this->getForm($this->modelForm);
         
        if (!$form->isValid($this->data)) {
            $this->logger->log('Form '.get_class($form).' is not valid',ZEND_LOG::WARN);
            return false;
        }
        
        $updating = false;
        
        /** 
         * @var $model Application_Model_Oferta 
         */
        $model = null;

        if ( isset($this->data['id']) && (int)$this->data['id'] > 0)
        {
            $ofertaId = $this->data['id'];
            $model = $this->repository->find($this->modelClass,$ofertaId);
            $this->logger->log('Updating '.strstr($this->modelClass,'Application_Model_'). $this->data['id'].'...',ZEND_LOG::DEBUG);    

            if (!$model)
                throw new Application_Service_Exception(strstr($this->modelClass,'Application_Model_').' cu id '.$this->data['id']. 'nu exista pt actualizare');
            
            $updating = true;   
        } else {
            $model = new $this->modelClass;
        }

        $this->repository->save($model);

        try {
            $this->repository->flush();
        } catch (ORMException $e) {
            throw new Application_Service_Exception ($e->getMessage());
        }
       
        return $updating==true ? true : $model->getId();        
    }    
    
    public function delete($id)
    {
        $childClass = get_class($this);
        $model = $this->repository->find($this->modelClass,$id);
        
        if (is_null($model))
            throw new Application_Service_Exception('Nu am gasit '.strstr($this->modelClass,'Application_Model_').' cu id: '.$id); 
        try {
    	    $this->repository->remove($model);
    	    $this->repository->flush();
        }
        catch (ORMException $e)
        {
            throw new Application_Service_Exception('Nu am putut sterge '.strstr($this->modelClass,'Application_Model_').' cu id: '.$id.';\n '.$e->getMessage());
        }
        return true;
        
    }

    protected function setIdentity ($identity)
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
    
    protected function getIdentity ()
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
    
    protected function setAcl($acl)
    {
        $this->_acl = $acl;
    }

    protected function getAcl()
    {
        if (null === $this->_acl) {
            $this->setAcl(new Application_Model_Acl_Sutatur());
        }
        return $this->_acl;
    }    

    protected function checkAcl($action)
    {
        return $this->getAcl()->isAllowed(
            $this->getIdentity(), 
            $this, 
            $action
        );
    }
        
    /**
     * Returns a form object
     * @return Zend_Form
     * @param string $type
     */
    public function getForm($name)
    {
        $name  = ucfirst($name);
        if (!isset($this->forms[$name])) {
            $class = 'Application_Form_' . $name;
            $this->forms[$name] = new $class;
        }
        return $this->forms[$name];
    }    
  
}
?>