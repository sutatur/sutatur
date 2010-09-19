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
     * @Column(name="nume", type="string", length=20, columnDefinition="CHAR(20) NOT NULL") 
     * @var string
     */
    private $nume;
    
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

}

