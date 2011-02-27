<?php
/**
 * @Entity
 * @Table (name="imagine")
 * @author angel
 *
 */

class Application_Model_Imagine
{
   
 /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume imagine
     * @Column(name="nume", type="string", length=13, columnDefinition="CHAR(13) NOT NULL") 
     * @var string
     */
    private $nume;
    

    
    function __construct($imagine='')
    {
        if ($imagine !== '') $this->nume = $imagine;
        return $this;
    }
	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

	/**
     * @param $id the $id to set
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $nume
     */
    public function getNume ()
    {
        return $this->nume;
    }

	/**
     * @param $nume the $nume to set
     */
    public function setNume ($nume)
    {
        $this->nume = $nume;
    }

}

