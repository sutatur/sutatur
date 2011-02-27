<?php
require_once 'Zend/Application.php'; 
class Model_DestinatieTest extends PHPUnit_Framework_TestCase
{
    const MODEL_NAME = 'Application_Model_Destinatie';

    /**
     * @var $model Application_Model_Destinatie
     */
    private $model;
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    
    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV,
              APPLICATION_PATH . '/configs/application.ini'
        );
        $this->bootstrap->bootstrap();        
        
//        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
        $this->_em = $this->bootstrap->bootstrap('Entitymanagerfactory');

        $this->model = new Application_Model_Destinatie;
    }
 
    public function testCreereTara()
    {
        $this->model->setNume('Romania');
        $this->model->esteTara();
        $this->_em->persist($this->model);
        $this->_em->flush();
    }
    
    public function testCircuiteInDestinatie()
    {
        /**
         * 
         * @var $destinatie Application_Model_Destinatie  
         */
        $destinatie = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume('Suceava');
        $this->assertNotNull($destinatie,'Nu am gasit nici o destinatie cu numele Suceava.');
        $circuite = $destinatie->getDestinatieCircuite();
        //var_dump($circuite->toArray(),"Circuite returnate:");
        foreach ($circuite as $circuit)
            $this->assertGreaterThan(1,strlen($circuit->getNume()));      
    }
    
    public function testCanReadFromRepository()
    {
        /**
         * @var $tara Application_Model_Destinatie
         */
        $tara = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume('Romania');
        $this->assertNotNull($tara,'Nu s-a gasit tara!');
        $this->assertEquals($tara->getNume(),'Romania');
        
    }
/*    
//    public function testCanCreateOras()
//    {
//        $numeOras = 'Suceava';
//        $numeTara = 'Romania';
//        $tara = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume($numeTara);
//        $oras = new Application_Model_Destinatie();
//        $oras->setNume($numeOras);
//        $oras->setTara($tara);
//        $this->_em->persist($oras);
//        try {
//        	$this->_em->flush();
//        } catch (PDOException $e) {
//            echo "Destinatia deja exista"."\n";
//        } 
//        
//        /**
//         * @var $dest Application_Model_Destinatie
//         */
//      //  $dest = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume($numeOras);
//        $this->assertEquals($dest->getNume(),$numeOras);
//        $this->assertEquals($dest->getTara()->getNume(),$numeTara);
//      //  $this->_em->remove($dest);
//      /*
//      try {
//        $this->_em->flush();
//      }
//    catch (\Doctrine\ORM\ORMException $e) {
//           echo "Caught Exception ('{$e->getMessage()}')\n";
//        } 
//    }
 
    public function tearDown() {
      	//$this->_em->remove($this->model);
    }
}