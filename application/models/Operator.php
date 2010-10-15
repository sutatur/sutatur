<?php
/**
 * @Entity 
 * @Table (name="operator")
 * @author angel
 *
 */
use \Doctrine\Common\Collections;      
class Application_Model_Operator
{

    /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume operator
     * @Column(name="nume", type="string", length=60) 
     * @var string
 
     */
    private $nume;

    /**
     * Email operator
     * @Column (name="email",  type="string", length=60)
     * @var string
     */
    private $email;

    /**
     * @Column (name="oras", type="string", length=30)
     * @var string
     */
    private $oras;

    /**
     * @Column (name="cod_postal", type="integer", columnDefinition="MEDIUMINT(6) NOT NULL")
     * @var string
     */
    private $codPostal;

    /**
     * @Column (name="judet", type="string", columnDefinition="CHAR(2) NOT NULL")
     * @var string
     */
    private $judet;

    /**
     * @Column(name="strada", type="string", length="90")
     */
    private $strada;

    /**
     * @Column(name="website", type="string", length="40", nullable=true)
     */
    private $website;

    /**
     * @Column(name="persoana_contact", type="string", length="40", nullable=false)
     */
    private $persoanaContact;

    /**
     * @Column(name="telefon", type="string", length="15")
     */
    private $telefon;

    /**
     * @Column(name="telefon2", type="string", length="15")
     */
    private $telefon2;

    /**
     * @Column(name="logo", type="string", columnDefinition = "CHAR(12) NULL")
     */
    private $logo;

    /**
     * @Column(name="yahoo_id", type="string", columnDefinition = "CHAR(30) NULL")
     */
    private $yahooId;

    /**
     * @Column(name="data_creare", type="datetime");
     */
    private $dataCreare;

    /**
     * @Column(name="data_ultima_autentificare", type="datetime");
     */
    private $dataUltimaAutentificare;

    /**
     * @Column(name="activat", type="boolean", columnDefinition="tinyint(1) unsigned NULL DEFAULT 0")
     * Daca operatorul este activat
     * @var boolean
     */
    private $activat;

    /**
     * @Column(name="accepta_email", type="boolean", columnDefinition="tinyint(1) unsigned NULL DEFAULT 1")
     * Daca operatorul accepta email
     * @var boolean
     */
    private $acceptaEmail;

    /*
     * Inverse Side
     * 
	 * @OneToMany (targetEntity="Application_Model_Sejur", mappedBy="operator")
	 * @var ArrayCollection;
	 */
    private $sejururiAdaugate;

    /**
     * Inverse side
     * 
	 * @OneToMany (targetEntity="Application_Model_Circuit", mappedBy="operator")
	 * @var ArrayCollection;
	 */
    private $circuiteAdaugate;
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
    public function getnume ()
    {
        return $this->nume;
    }

	/**
     * @param $nume the $nume to set
     */
    public function setnume ($nume)
    {
        $this->nume = $nume;
    }

	/**
     * @return the $email
     */
    public function getEmail ()
    {
        return $this->email;
    }

	/**
     * @param $email the $email to set
     */
    public function setEmail ($email)
    {
        $this->email = $email;
    }

	/**
     * @return the $oras
     */
    public function getOras ()
    {
        return $this->oras;
    }

	/**
     * @param $oras the $oras to set
     */
    public function setOras ($oras)
    {
        $this->oras = $oras;
    }

	/**
     * @return the $codPostal
     */
    public function getCodPostal ()
    {
        return $this->codPostal;
    }

	/**
     * @param $codPostal the $codPostal to set
     */
    public function setCodPostal ($codPostal)
    {
        $this->codPostal = $codPostal;
    }

	/**
     * @return the $judet
     */
    public function getJudet ()
    {
        return $this->judet;
    }

	/**
     * @param $judet the $judet to set
     */
    public function setJudet ($judet)
    {
        $this->judet = $judet;
    }

	/**
     * @return the $strada
     */
    public function getStrada ()
    {
        return $this->strada;
    }

	/**
     * @param $strada the $strada to set
     */
    public function setStrada ($strada)
    {
        $this->strada = $strada;
    }

	/**
     * @return the $website
     */
    public function getWebsite ()
    {
        return $this->website;
    }

	/**
     * @param $website the $website to set
     */
    public function setWebsite ($website)
    {
        $this->website = $website;
    }

	/**
     * @return the $persoanaContact
     */
    public function getPersoanaContact ()
    {
        return $this->persoanaContact;
    }

	/**
     * @param $persoanaContact the $persoanaContact to set
     */
    public function setPersoanaContact ($persoanaContact)
    {
        $this->persoanaContact = $persoanaContact;
    }

	/**
     * @return the $telefon
     */
    public function getTelefon ()
    {
        return $this->telefon;
    }

	/**
     * @param $telefon the $telefon to set
     */
    public function setTelefon ($telefon)
    {
        $this->telefon = $telefon;
    }

	/**
     * @return the $telefon2
     */
    public function getTelefon2 ()
    {
        return $this->telefon2;
    }

	/**
     * @param $telefon2 the $telefon2 to set
     */
    public function setTelefon2 ($telefon2)
    {
        $this->telefon2 = $telefon2;
    }

	/**
     * @return the $logo
     */
    public function getLogo ()
    {
        return $this->logo;
    }

	/**
     * @param $logo the $logo to set
     */
    public function setLogo ($logo)
    {
        $this->logo = $logo;
    }

	/**
     * @return the $yahooId
     */
    public function getYahooId ()
    {
        return $this->yahooId;
    }

	/**
     * @param $yahooId the $yahooId to set
     */
    public function setYahooId ($yahooId)
    {
        $this->yahooId = $yahooId;
    }

	/**
     * @return the $dataCreare
     */
    public function getDataCreare ()
    {
        return $this->dataCreare;
    }

	/**
     * @param $dataCreare the $dataCreare to set
     */
    public function setDataCreare ($dataCreare)
    {
        $this->dataCreare = $dataCreare;
    }

	/**
     * @return the $dataUltimaAutentificare
     */
    public function getDataUltimaAutentificare ()
    {
        return $this->dataUltimaAutentificare;
    }

	/**
     * @param $dataUltimaAutentificare the $dataUltimaAutentificare to set
     */
    public function setDataUltimaAutentificare (
    $dataUltimaAutentificare)
    {
        $this->dataUltimaAutentificare = $dataUltimaAutentificare;
    }

	/**
     * @return the $activat
     */
    public function esteActivat ()
    {
        return $this->activat=== '1' ? true : false;
    }

	/**
     * @param $activat the $activat to set
     */
    public function activeaza ()
    {
        $this->activat = '1';
    }

	/**
     * @param $activat the $activat to set
     */
    public function dezActiveaza ()
    {
        $this->activat = '0';
    }
    
    
	/**
     * @return the $acceptaEmail
     */
    public function getAcceptaEmail ()
    {
        return $this->acceptaEmail;
    }

	/**
     * @param $acceptaEmail the $acceptaEmail to set
     */
    public function setAcceptaEmail ($acceptaEmail)
    {
        $this->acceptaEmail = $acceptaEmail;
    }

	/**
     * @return the $sejururiAdaugate
     */
    public function getSejururiAdaugate ()
    {
        return $this->sejururiAdaugate;
    }

	/**
     * @param $sejururiAdaugate 
     */
    public function adaugaSejur ($sejur)
    {
        $this->sejururiAdaugate[] = $sejur;
    }

	/**
     * @return the $circuiteAdaugate
     */
    public function getCircuiteAdaugate ()
    {
        return $this->circuiteAdaugate;
    }

	/**
     * @param $circuiteAdaugate the $circuiteAdaugate to set
     */
    public function adaugaCircuit ($circuit)
    {
        $this->circuiteAdaugate[] = $circuit;
    }

	public function __construct ()
    {
        $this->sejururiAdaugate = new ArrayCollection();
        $this->circuiteAdaugate = new ArrayCollection();
    }
}

