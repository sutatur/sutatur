<?php
/**
 * @author Angel
 */
require_once ('Zend\Form.php');

class Application_Form_OperatorRegister extends Zend_Form
{
    private $elementDecorators = array(
        'viewHelper',
        'label',
        array('htmlTag', array('tag' => 'li'))
    );
    
    private $formDecorators = array(
        'form',
        'formElements',
        array('htmlTag', array('tag' => 'ul'))
    );
    
    public function init()
    {
        $this->setDecorators($this->formDecorators);
        $this->setElementDecorators($this->elementDecorators);
    }
    
    public function __construct()
    {
         $this->addElement('text', 'nume', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 255)),
                  'Alpha'
            ),
            'required'   => true,
            'label'      => 'Nume',
        ));

         $this->addElement('text', 'email', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('EmailAddress', true)
            ),
            'required'   => true,
            'label'      => 'E-mail',
        ));

        $this->addElement('password', 'parola', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'label'      => 'Parola',
        ));  
                
         $this->addElement('text', 'persoanaContact', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 140)),
            ),
            'required'   => true,
            'label'      => 'Persoana contact',
        ));
        
        $this->addElement('text', 'Adresa', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 120)),
            ),
            'required'   => false,
            'label'      => 'Adresa',
        ));        
        
        $this->addElement('text', 'oras', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 120)),
            ),
            'required'   => true,
            'label'      => 'Oras',
        ));        

        $this->addElement('text', 'Judet', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 120)),
            ),
            'required'   => true,
            'label'      => 'Oras',
        ));   

        $this->addElement('text', 'webaddress', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 60)),
            ),
            'required'   => true,
            'label'      => 'Site',
        ));        

        $this->addElement('text', 'telefon1', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 10)),
                  'AlNum'
            ),
            'required'   => true,
            'label'      => 'Telefon 1',
        ));        
        
        $this->addElement('text', 'telefon2', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 10)),
                  'AlNum'
            ),
            'required'   => false,
            'label'      => 'Telefon 2',
        ));        
        
        
        $this->addElement('text', 'yahooid', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                  array('StringLength', false, array(0, 40)),
            ),
            'required'   => true,
            'label'      => 'Yahoo Messenger ID',
        ));        
        
        $this->addElement('submit', 'register', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'OK',
        ));        
        
    }
}
?>