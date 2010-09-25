<?php
/**
 * @Entity
 * @Table (name="destinatie") 
 */
class Application_Model_Destinatie
{
 /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume destinatie
     * @Column(name="nume", type="string", length=20, columnDefinition="CHAR(40) NOT NULL") 
     * @var string
     */
    private $nume;
    
    /**
     * @OneToOne (targetEntity = "Application_Model_Destinatie", cascade={"persist", "remove"})
     * @JoinColumn(name="destinatie_parent_id", referencedColumnName="id")
     * @var Application_Model_Destinatie
     */
    private $tara;
    /**
     * @ManyToMany(targetEntity="Application_Model_Circuit", mappedBy="destinatii")
     */
    private $circuite;
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

	/**
     * @return $tara Application_Model_Destinatie
     */
    public function getTara ()
    {
        return $this->tara;
    }

	/**
     * @param $tara the $tara to set
     */
    public function setTara (Application_Model_Destinatie $tara)
    {
        $this->tara = $tara;
    }

	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }
    
	/**
     * sets the id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }
    
	/**
     * @return the $circuite
     */
    public function getCircuite ()
    {
        return $this->circuite;
    }
    
}

