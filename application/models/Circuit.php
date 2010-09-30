<?php
/**
 * @Entity (repositoryClass="Application_Model_RepositoryCircuit")
 * @Table (name="circuit")
 * @HasLifecycleCallbacks
 * @author angel
 *
 */
class Application_Model_Circuit
{
 /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume operator
     * @Column(name="nume", type="string", length=20) 
     * @var string
     */
    private $nume;
    
 	/**
     * @Column(name="pret", type="decimal", precision=8, scale=2)
     */
    private $pret;

	/**
     * @Column(name="data_adaugare", type="datetime");
     * @var DateTime
     */    
    private $dataAdaugare;
    
    /**
     * @Column(name="data_valabilitate", type="datetime");
     * @var DateTime
     */
    private $dataValabilitate;
    
	/**
     * @Column(name="data_modificare",type="datetime")
     */
    private $dataModificare;    

    /**
     * @Column(name="descriere", type="text");
     */
    private $descriere;
    
    /**
     * @Column(name="promovata", type="boolean", columnDefinition="tinyint(1) unsigned NULL DEFAULT 0")
     * Daca oferta este promovata
     * @var boolean
     */
    private $promovata;

    /**
     * @Column(name="arhivata", type="boolean", columnDefinition="tinyint(1) unsigned NULL DEFAULT 0")
     * Daca oferta este arhivata
     * @var boolean
     */    
    private $arhivata;
    
 	/**
     * @ManyToOne(targetEntity="Application_Model_Operator", inversedBy="circuiteAdaugate")
     * @JoinColumn (name="operator_id", referencedColumnName="id")
     * @var Application_Model_Operator
     */
    private $operator;
    
    /**
     * @ManyToMany (targetEntity="Application_Model_Imagine", cascade={"persist", "remove"})
     * @JoinTable (name="poze_adaugate",
     * 	joinColumns={@JoinColumn(name="external_id", referencedColumnName="id")},
     *  inverseJoinColumns={@JoinColumn(name="imagine_id",referencedColumnName="id", unique="true")}
     *  )
	 * @var ArrayCollection;
     */
    private $imagini;
    
    /**
     * Bidirectional - owning
     * @ManyToMany (targetEntity="Application_Model_Destinatie", inversedBy="destinatieCircuite")
     * @JoinTable (name="destinatii_circuite",
     * 			   joinColumns={@JoinColumn(name="circuit_id",referencedColumnName="id")},
     *  		   inverseJoinColumns={@JoinColumn(name="destinatie_id",referencedColumnName="id")})	
     * @var ArrayCollection
     */
    private $destinatii;
    
    /**
     * Bidirectional
     * @ManyToOne(targetEntity="Application_Model_CategorieOferta", inversedBy="circuite")
     */
    private $categorieOferta;
    
    
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

	/**
     * @return the $pret
     */
    public function getPret ()
    {
        return $this->pret;
    }

	/**
     * @param $pret the $pret to set
     */
    public function setPret ($pret)
    {
        $this->pret = $pret;
    }

	/**
     * @return DateTime
     */    
    public function getDataAdaugare ()
    {
        return $this->dataAdaugare;
    }

	/**
     * @param $dataAdaugare the $dataAdaugare to set
     * @return DateTime
     */
    public function setDataAdaugare ($dataAdaugare)
    {
        $this->dataAdaugare = $dataAdaugare;
    }

	/**
     * @return the $dataValabilitate
     */
    public function getDataValabilitate ()
    {
        return $this->dataValabilitate;
    }

	/**
     * @param $dataValabilitate the $dataValabilitate to set
     */
    public function setDataValabilitate ($dataValabilitate)
    {
        $this->dataValabilitate = $dataValabilitate;
    }

	/**
     * @return the $descriere
     */
    public function getDescriere ()
    {
        return $this->descriere;
    }

	/**
     * @param $descriere the $descriere to set
     */
    public function setDescriere ($descriere)
    {
        $this->descriere = $descriere;
    }

	/**
     * @return the $operator
     */
    public function getOperator ()
    {
        return $this->operator;
    }

	/**
     * @param $operator the $operator to set
     */
    public function setOperator ($operator)
    {
        $this->operator = $operator;
    }

    public function esteArhivata()
    {
        return $this->arhivata === 1 ? true : false;
    }
    
    public function arhiveaza()
    {
        $this->arhivata = 1;
    }
    
    public function estePromovata()
    {
        return $this->promovata === 1 ? true : false;
    }
    
    public function promoveaza()
    {
        $this->promovata = 1;
    }
    
	public function __construct()
    {
        $this->imagini = new \Doctrine\Common\Collections\ArrayCollection();
        $this->destinatii = new \Doctrine\Common\Collections\ArrayCollection();
        
        $this->dataAdaugare = $this->dataModificare = new \DateTime("now");
    }
    
    public function getImagini()
    {
        return $this->imagini->toArray();
    }
    /**
     * @param Application_Model_Destinatie $destinatie
     */
    
    public function adaugaDestinatie(Application_Model_Destinatie $destinatie)
    {
        $this->destinatii->add($destinatie);
        $destinatie->adaugaCircuit($this);
    }
    
    public function getDestinatii()
    {
        return $this->destinatii->toArray();
    }
    /**
     * 
     * @param Application_Model_Imagine $imagine
     */
    public function adaugaImagine(Application_Model_Imagine $imagine)
    {
        $this->imagini[] = $imagine;
    }
	/**
     * @return Application_Model_CategorieOferta
     */
    public function getCategorieOferta ()
    {
        return $this->categorieOferta;
    }

	/**
     * @param $categorieOferta the $categorieOferta to set
     */
    public function setCategorieOferta (Application_Model_CategorieOferta $categorieOferta)
    {
        $this->categorieOferta = $categorieOferta;
        $categorieOferta->adaugaCircuit($this);
    }
    public function __toString()
    {
        return __CLASS__;
    }
    
    /**
     * @PrePersist
     */
    public function updated()
    {
        $this->dataModificare = new DateTime("now");
    }    
}

