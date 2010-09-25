<?php 
class Model_DestinatieTest extends ControllerTestCase
{
    const MODEL_NAME = 'Application_Model_Destinatie';
    private $model;
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    
    public function setUp()
    {
        parent::setUp();
        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
        //$this->em = Front_Api_Util_Bootstrap::getResource('Entitymanagerfactory');
        /**
         * @var $model Application_Model_Destinatie
         */
        $this->model = new Application_Model_Destinatie;
        $this->model->setNume('Romania');
        
        
    }
 
    public function testCanPersist()
    {
        $this->_em->persist($this->model);
        $this->_em->flush();
    }
    
    public function testCanReadFromRepository()
    {
        /**
         * @var $tara Application_Model_Destinatie
         */
        $tara = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume('Romania');
        $this->assertEquals($tara->getNume(),'Romania');
        
    }
    
    public function testCanCreateChildDestinatie()
    {
        $tara = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume('Romania');
        $dest = new Application_Model_Destinatie()    ;
        $dest->setNume('Bucovina');
        $dest->setTara($tara);
        $this->_em->persist($dest);
        $this->_em->flush();
        $dest = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume('Bucovina');
        $this->assertEquals($dest->getNume(),'Bucovina');
        $this->_em->remove($dest);
        $this->_em->flush(); 
    }
    
    public function tearDown() {
    	$this->_em->remove($this->model);
    }
}