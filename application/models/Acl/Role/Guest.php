<?php
require_once ('Zend\Acl\Role\Interface.php');
/** 
 * @author angel
 * 
 * 
 */
class Application_Model_Acl_Role_Guest implements Zend_Acl_Role_Interface
{
    public function getRoleId()
    {
        return 'guest';
    }
}
?>