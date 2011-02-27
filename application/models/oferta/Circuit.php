<?php
/**
 * //@Entity (repositoryClass="Application_Model_RepositoryCircuit")
 * @Table (name="circuit")
 * @author angel
 *
 */
use Doctrine\Common\Collections\ArrayCollection;

class Application_Model_Oferta_Circuit extends Application_Model_Oferta
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
        parent::__construct();

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
	/**
     * @param $destinatii array
     */
    public function setDestinatii ($destinatii)
    {
        if (is_array($destinatii))
            foreach ($destinatii as  $destinatie_id)
            {
                $destinatie = new Application_Model_Destinatie($destinatie_id);
                $this->destinatii->add($destinatie);
                unset($destinatie);
            }
        else
        throw new Application_Model_Exception(get_class($this).'::'.__FUNC__. 'trebuie sa primeasca ca parametru un array');
    }
    
    public function setData($data)
    {
        isset($data['destinatii']) ? $this->setDestinatii($data['destinatii']) : '';
    }
}

