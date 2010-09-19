<?php
class SutaTurism_Form_Login extends Zend_Form
{
	function init()
	{
		$username = $this->addElement('text','username',array(
		    'filters' => array('StringTrim','StringToLower'),
		    'validators' => array(
		        'Alpha',
		        array('StringLength',false,array(3,20)),
            ),
            'require' => true,
            'label' => 'Username:'));

        $password = $this->addElement('password', 'password', array(
            'filters'    => array('StringTrim'),
            'validators' => array(
                'Alnum',
                array('StringLength', false, array(6, 20)),
            ),
            'required'   => true,
            'label'      => 'Password:',
        ));

        $login = $this->addElement('submit', 'login', array(
            'required' => false,
            'ignore'   => true,
            'label'    => 'Login',
        ));
        
        //$this->setAction('/admin/auth/process');
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag',array('tag' => 'dl', 'class' => 'zend_form')),
            array('Description',array('placement' => 'prepend')),
            'Form'
            ));
        
	}
	
	/**
     * Validate the form
     *
     * @param  array $data
     * @return boolean
     */
    public function isValid($data)
	{
	    return true;
	}
} 
?>