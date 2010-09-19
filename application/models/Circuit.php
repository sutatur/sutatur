<?php
/**
 * @Entity
 * @Table (name="circuit")
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
     * @Column(name="pret", type="decimal", precision=2)
     */
    private $pret;

	/**
     * @Column(name="data_adaugare", type="datetime");
     */    
    private $dataAdaugare;
    
    /**
     * @Column(name="data_valabilitate", type="datetime");
     */
    private $dataValabilitate;

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
     * @ManyToMany (targetEntity="Application_Model_Imagine", mappedBy="operator")
     * @JoinTable (name="poze_adaugate",
     * 	joinColumns={@JoinColumn(name="oferta_id", referencedColumnName="id")},
     *  inverseJoinColumns={@JoinColumn(name="imagine_id",referencedColumnName="id")}
     *  )
	 * @var ArrayCollection;
     */
    private $imagini;
    
    /**
     * @OneToMany (targetEntity="Application_Model_Destinatie", mappedBy="circuit")
     * @var ArrayCollection
     */
    private $destinatii;
    
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
     * @return the $dataAdaugare
     */
    public function getDataAdaugare ()
    {
        return $this->dataAdaugare;
    }

	/**
     * @param $dataAdaugare the $dataAdaugare to set
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
    }
    
}

