<?php

class OperatorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        echo "I'm at operator";
    }

    public function loginAction()
    {
        $authService = new Application_Service_Authentication();
        if($authService->isAuthenticated() == true) {
            $this->_redirect('/index');
        }
    
        if($this->getRequest()->isPost()) {
            $this->view->headTitle('Login');
            // collect the data from the user
            $loginUsername = $this->getRequest()->getParam('username', '');
            $loginPassword = $this->getRequest()->getParam('password', '');
    
            $authResult = $authService->authenticate(
                $loginUsername,
                $loginPassword
            );
    
            if($authResult == true) {
                // auth good, do your logic
            }
            else {
                // auth bad, do your logic
            }
        } else {
            $this->_redirect('/login');
        }
    }
}

