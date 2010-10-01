<?php
use \Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity (repositoryClass="Application_Model_RepositoryDestinatie")
 * @Table (name="destinatie", uniqueConstraints={@UniqueConstraint(columns={"tara_id", "nume"})}))
 * @HasLifecycleCallbacks
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
     * @OneToMany (targetEntity="Application_Model_Destinatie", mappedBy="tara")
     */
    private $orase;
    
    /**
     * @ManyToOne (targetEntity="Application_Model_Destinatie", inversedBy="orase")
     * @JoinColumn (name="tara_id", referencedColumnName="id")
     */
    private $tara;
    /**
     * Bidirectional - Returneaza circuitele pt o anumita destinatie
     * @ManyToMany(targetEntity="Application_Model_Circuit", mappedBy="destinatii")
     */
    private $destinatieCircuite;
    
    /**
     * @Column (name="imagine", type="string", length=13, nullable="true", columnDefinition="CHAR (12) NULL")
     * @var string
     */
    private $imagine; 
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
     * @return the $orase
     */
    public function getOrase ()
    {
        return $this->orase;
    }

	/**
     * @param $orase the $orase to set
     */
    public function adaugaOras (Application_Model_Destinatie $oras)
    {
        $this->tara = $this;
        $this->orase[] = $oras;
    }
    
	/**
     * @return the $imagine
     */
    public function getImagine ()
    {
        return $this->imagine;
    }

	/**
     * @param $imagine the $imagine to set
     */
    public function setImagine ($imagine)
    {
        $this->imagine = $imagine;
    }

	public function esteTara ()
    {
        $this->parent = null;
    }
    public function setTara(Application_Model_Destinatie $tara)
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
     * @param Application_Model_Circuit $circuit
     */
    public function adaugaCircuit(Application_Model_Circuit $circuit)
    {
    //    $this->destinatieCircuite[] = $circuit;
        $this->destinatieCircuite->add($circuit);
    }
    
    public function __construct()
    {
        $this->destinatieCircuite= new ArrayCollection();
        $this->orase = new ArrayCollection();
    }
	/**
     * @return the $destinatieCircuite
     */
    public function getDestinatieCircuite ()
    {
        return $this->destinatieCircuite;
    }
}

