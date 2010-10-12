<?php
require_once ('Zend\Acl\Resource\Interface.php');
class Application_Model_Acl_Resource_Admin implements Zend_Acl_Resource_Interface
{
    public function getResourceId()
    {
        return 'Admin';
    }    
}
?>