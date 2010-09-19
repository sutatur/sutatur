<?php
class SutaTurism_Form_Element_FileImage extends Zend_Form_Element
{
	public $helper = 'FileImage';
	
	public $options;

	public function __construct($image_name, $attributes, $data_item)
	{
		$this->options = $data_item;
		parent::__construct($image_name, $attributes);
	}
	
	public  function isValid($value, $context = null)
	{
		return true;
	}
} 
?>