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
     * @OneToOne (targetEntity = "Application_Model_Destinatie")
     * @JoinColumn(name="destinatie_parent_id", referencedColumnName="id")
     * @var Application_Model_Destinatie
     */
    private $tara;

}

