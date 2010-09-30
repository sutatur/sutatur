<?php
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
     * @OnetoMany (targetEntity="Application_Model_Circuit", mappedBy="categorieOferta" )
     */
    private $circuite;
    
    public function __construct($nume = null)
    {
        if ($nume !== null)
            $this->setNume($nume);
            
        $this->circuite = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return the $circuite
     */
    public function getCircuite ()
    {
        return $this->circuite;
    }

	/**
     * @param $circuite
     */
    public function adaugaCircuit (Application_Model_Circuit $circuit)
    {
        $this->circuite[] = $circuit;
    }

    public function eliminaCircuit (Application_Model_Circuit $circuit)
    {
        $this->circuite->removeElement($circuit);
    }

}

