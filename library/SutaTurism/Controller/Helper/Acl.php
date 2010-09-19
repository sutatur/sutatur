<?php
/*
 * Acl action helper used for when we want to control access to resources
 * that do not have a Model.
 * 
 * @author Angel <angel@sutalasuaturism.com>
 */
class SutaTurism_Controller_Helper_Acl extends Zend_Controller_Action_Helper_Abstract
{
    /**
     * @var Zend_Acl
     */
    protected $_acl;
    
    /**
     * @var string
     */
    protected $_identity;
    
    /**
     * Init the instance for this module
     */
    public function init()
    {
        $module = $this->getRequest()->getModuleName();
        $acl = ucfirst($module) . '_Acl_Acl';
        
        if (class_exists($acl)) {
            $this->_acl = new $acl;
        }
    }
	/**
	 * @return the $_acl
	 */
	public function getAcl() {
		return $this->_acl;
	}
	
	/**
	 * Check the acl
	 * 
	 * @param string resource
	 * @param string $privilege
	 * @return boolean
	 */
	public function isAllowed($resource = null, $privilege=null)
	{
		if (null === $this->_acl){
		    return null;
		}
		return $this->_acl->isAllowed($this->getIdentity(),$resource,$privilege);
	}
	
	/**
	 * Set the identity of the current request
	 * 
	 * @param array|string|null Zend_Acl_Role_Interface $identity
	 */
    public function setIdentity($identity)
    {
        if (null === $identity)
            $identity = new Zend_Acl_Role('guest');

        $this->_identity = $identity;
        return $this;    
    }

    /**
     * Get the identity. If none is speficied, returns guest
     * @return string
     */
    
    public function getIdentity()
    {
     if (null === $this->_identity) {
         $auth = Zend_Auth::getInstance();
         if (!$auth->hasIdentity()) {
             return 'guest';
         }
     }
     $this->setIdentity($auth->getIdentity());
         
     return $this->_identity;
    }

	/**
     * Proxy to the isAllowed method
     */
    public function direct($resource=null, $privilege=null)
    {
        return $this->isAllowed($resource, $privilege);
    }    
}