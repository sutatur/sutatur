<?php
require_once ('application\services\Abstract.php');

class Application_Service_Authentication extends Application_Service_Abstract
{
    private $_authenticationMessage = '';
        
    public function populateModel(Abstract_Model $model)
    {
        
    }

    public function getAuthenticationMessage()
    {
        return $this->_authenticationMessage;
    }

    public function isAuthenticated()
    {
        return Zend_Auth::getInstance()->hasIdentity();
    }

    public function authenticate($username, $password)
    {
        $doctrineAuthAdapter = new ZendX_Doctrine_Auth_Adapter(
            Doctrine_core::getConnectionByTableName('Model_User')
        );
        $doctrineAuthAdapter->setTableName('Model_User u')
            ->setIdentityColumn('u.username')
            ->setCredentialColumn('u.password')
            ->setIdentity($username)
            ->setCredential(Model_Utility::encryptPassword($password));

        $myAuth = Zend_Auth::getInstance();
        $authResult = $myAuth->authenticate($doctrineAuthAdapter);
        if(!$authResult->isValid()) {
            $this->_authenticationMessage = 'You have entered invalid username and password.';
            return false;
        } else {
            $identity = $doctrineAuthAdapter->getResultRowObject(null, 'password');
            $myAuth->getStorage()->write($identity);
            return true;
        }
    }
    
}
?>