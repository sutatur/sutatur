<?php 
class Model_ImagineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    /**
     * @var $categorieOferta Application_Model_Imagine
     */
    private $model;
    
    public function setUp()
    {
        parent::setUp();
        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
    }
    
    public function testConstructor()
    {
          $numeImagine = 'xx.jpg';   
        $this->model = new Application_Model_Imagine($numeImagine);
        $this->assertEquals($numeImagine,$this->model->getNume());
    }
 
    public function testCanPersist()
    {
        $numeImagine = 'xx.jpg';   
        $this->model = new Application_Model_Imagine($numeImagine);
        $this->_em->persist($this->model);
        $this->_em->flush();

        $imagine = $this->_em->getRepository('Application_Model_Imagine')->findOneByNume( $numeImagine = 'xx.jpg');
        $this->assertNotNull($imagine,"Nu a fost gasita nici o imagine");
    }
    
    public function tearDown() {
    	$this->_em->remove($this->model);
    	$this->_em->flush();
    }
}