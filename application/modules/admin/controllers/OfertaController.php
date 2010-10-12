<?php

class Admin_OfertaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function adaugaAction()
    {
        $service = $this->getService('Oferta');
        $service->setData($this->getRequest($this->getRequest()->getPost()));
        try {
            $service->adaugaOferta();	
        } catch (Application_Service_Exception $e) {
            $this->view->flashMessenger($e->getMessage());
            $this->view->ofertaForm = $this->getForm('Oferta');
        }
    }

    private function getForm($nume)
    {
        $form = 'Application_Form_'.$nume;
        return new $form;        
    }


}



