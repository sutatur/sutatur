<?php
use \Doctrine\Common\Collections\ArrayCollection;
/**
 * @Entity
 * @Table (name="categorie_oferta")
 * @author angel
 *
 */
class Application_Model_CategorieOferta
{

    /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume operator
     * @Column(name="nume", type="string", length=20, unique=true, columnDefinition="CHAR(20) NOT NULL") 
     * @var string
     */
    private $nume;
    
    
    /**
     * Bidirectional owning side
     * @OnetoMany (targetEntity="Application_Model_Oferta", mappedBy="categorieOferta" )
     */
    private $oferte;
    
    public function __construct($nume = '')
    {
        if (isset($nume) && strlen($nume) > 0)
            $this->setNume($nume);
            
        $this->oferte = new ArrayCollection();
    }
	public function getId ()
    {
        return $this->id;
    }

	public function setId ($id)
    {
        $this->id = $id;
    }

	public function getNume ()
    {
        return $this->nume;
    }

	public function setNume ($nume)
    {
        $this->nume = $nume;
    }
	/**
     * @return \Doctrine\Common\Collections\ArrayCollection()
     */
    public function getOferte ()
    {
        return $this->oferte;
    }

	/**
     * @param $oferta Application_Model_Oferta
     */
    public function adaugaOferta (Application_Model_Oferta $oferta)
    {
        $this->oferte->add($oferta);
    }

    public function eliminaOferta (Application_Model_Oferta $oferta)
    {
        $this->oferte->removeElement($oferta);
    }

}

