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

    
  }

