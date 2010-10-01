<?php
/**
 * @Entity (repositoryClass="Application_Model_RepositoryCircuit")
 * @Table (name="circuit")
 * @author angel
 *
 */
use \Doctrine\Common\Collections\ArrayCollection;

class Application_Model_Circuit extends Application_Model_Oferta
{
    /**
     * Bidirectional - owning
     * @ManyToMany (targetEntity="Application_Model_Destinatie", inversedBy="destinatieCircuite")
     * @JoinTable (name="destinatii_circuite",
     * 			   joinColumns={@JoinColumn(name="circuit_id",referencedColumnName="id")},
     *  		   inverseJoinColumns={@JoinColumn(name="destinatie_id",referencedColumnName="id")})	
     * @var ArrayCollection
     */
    private $destinatii;
    
 	public function __construct()
    {
        $this->destinatii = new ArrayCollection();
        
        $this->dataAdaugare = $this->dataModificare = new \DateTime("now");
    }
    
    /**
     * @param Application_Model_Destinatie $destinatie
     */
    
    public function adaugaDestinatie(Application_Model_Destinatie $destinatie)
    {
        if (! $this->destinatii->contains($destinatie))
        {
            $this->destinatii->add($destinatie);
            $destinatie->adaugaCircuit($this);
        }
    }
        
    public function getDestinatii()
    {
           return $this->destinatii->toArray();
    }
}

