<?php

/**
 * @see Zend_Form
 * @author angel
 *
 */
class Application_Form_OfertaSejur extends Zend_Form
{

    public function init()
    {   
        /** @var Application_Service_Destinatie */
        $destinatiiService = $this->getService('Destinatie');
        $ofertaService = $this->getService('Oferta');
        
        $listaTari = $destinatiiService->getListaDestinatiiTara(1);
        $categoriiOferta = $ofertaService->getListaCategoriiOferta();

        
        //$listaDestinatii = $destinatiiService->getListaDestinatiiTara($this->_elements['destinatie']->getValue());

    /*
        array('Label', array('requiredSuffix' => ' *',
                                  'tag' => 'dt',
                                  'escape' => false))
        */ 
        $this->addElementPrefixPath('ZendX_Doctrine2_Validate', 'ZendX/Doctrine2/Validate/', 'validate');
        
        /* form elements */

        $this->addElement('text', 'nume', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 255)),
            ),
            'required'   => true,
            'label'      => 'Nume',
        ));

        $this->addElement('select', 'categorieOferta', array(
            'validators' => array(
  //              array('RecordExists', false, array('table' => 'Application_Model_CategorieOferta','field' => 'id')),
            ),
            'required' => true,
            'multiOptions' => $categoriiOferta,
            'RegisterInArrayValidator' => false,
            'label' => 'Categorie oferta'
        ));
        
        $this->addElement('select', 'tara', array(
            'validators' => array(
                array('stringLength', true, array(6, 20)),
//            	array('RecordExists', false, array('table' => 'Application_Model_Destinatie','field' => 'id'))
            ),
            'multiOptions' => $listaTari,
            'RegisterInArrayValidator' => false,	
            'label' => 'Tara'
            	
        ));
     
        $this->addElement('text', 'dataValabilitate', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Valabilitate',
        ));        

         $this->addElement('text', 'pret', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Float', 
                 array('StringLength', false, array(0, 255)),
            ),
            'required'   => true,
            'label'      => 'Pret',
        ));
        
     $this->addElement('textarea', 'descriere', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => 'Descriere',
        ));        
     //   if (isset($this->))
        
    }

    private function getService($name)
    {
        $autoLoader = Zend_Loader_Autoloader::getInstance();
        $resourceLoader = $autoLoader->getNamespaceAutoloaders('Application_');
        
        return $resourceLoader[0]->getService($name);
    }
}

