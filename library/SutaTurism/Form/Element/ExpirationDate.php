<?php

/** 
 * @author angel
 * 
 * @uses Zend_Form_Element_Xhtml
 * sets the viewer
 */
class SutaTurism_Form_Element_ExpirationDate extends Zend_Form_Element_Xhtml
{
	public $helper = 'expirationDate';
	
	public  function isValid($value, $context = null)
	{
		$name = $this->getName();
		
		// construct the ExpDate custome element value from POST values
		// POST values are copied in $conext var
		$value = $context[$name]['month'].' / '.$context[$name]['year'];

		$this->_value = $value;
		
		return true;
	}
	
	
	
}

?>