<?php
class Application_Model_Acl_Sutatur extends Zend_Acl
{
 /**
     * Add the roles to the acl and deny all by default
     */
    public function __construct()
    {
        // Define roles:
        $this->addRole(new Application_Model_Acl_Role_Guest)
             ->addRole(new Application_Model_Acl_Role_Operator, 'guest')
             ->addRole(new Application_Model_Acl_Role_Admin, 'operator');

        // Deny privileges by default; i.e., create a whitelist
        $this->deny();

        // Add permission for non Model access restrictions
        $this->add(new Application_Model_Acl_Resource_Admin())
             ->allow('admin')
             ->add(new Application_Service_Oferta())
             ->allow('operator');
             
        //$this->add(new Application_model_a)
    }    
}
?>