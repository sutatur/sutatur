<?php
/**
 * @Entity
 * @Table (name="imagine")
 * @author angel
 *
 */
class Application_Model_Imagine
{
 /**
     * @Id @Column (name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * Nume imagine
     * @Column(name="nume", type="string", length=13, columnDefinition="CHAR(13) NOT NULL") 
     * @var string
     */
    private $nume;

}

