<?php
/**
 * @Entity
 * @Table (name="sejur")
 * @author angel
 *
 */
class Application_Model_Sejur  extends Application_Model_Oferta
{
    /**
     * Unidirectional ManyToOne
     * @ManyToOne (targetEntity="Application_Model_Destinatie")
     * @var Application_Model_Destinatie
     */
    private $destinatie;
	/**
     * @return Application_Model_Destinatie 
     */
    public function getDestinatie ()
    {
        return $this->destinatie;
    }

	/**
     * @param $destinatie Application_Model_Destinatie 
     */
    public function setDestinatie (Application_Model_Destinatie $destinatie)
    {
        $this->destinatie = $destinatie;
    }
    
    public function __construct() {
    	parent::__construct();
    }
    
    /**
     * 
     * @param Array $data
     */
    public function populate($data)
    {
        parent::populate();
        if (isset($data['destinatie'])) $this->setDestinatie($data['destinatie']);
    }
    
  }

