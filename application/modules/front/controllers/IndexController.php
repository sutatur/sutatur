<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->getInvokeArg('bootstrap')->log->debug("I'm at indexAction");
    }


}

