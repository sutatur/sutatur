<?php
/** 
 * @author angel
 * 
 * 
 */


abstract class Application_Model_Abstract implements Application_Model_Entity
{
    /**
     * Array ce stocheaza datele pt fiecare model
     * @var Array
     */
    private $data;
    
    public function _setData($data)
    {
        if (count($data) == 0)
            return;

        $modelProperties = get_class_vars(get_class());
//        
        foreach ($data as $atribut  => $value) {
            //exit();
        	if (isset($modelProperties[$atribut]))
        	{
        	    var_dump($atribut);
        	    $method = 'set'.ucfirst($atribut);
        	    $this->$method($value);
        	}
        	else
        	    throw new Application_Model_Exception (get_class($this). ' nu contine '.$atribut.'. Lista atribute: '.implode(',',$modelProperties));
        	
        }
        
    }

  
}
?>