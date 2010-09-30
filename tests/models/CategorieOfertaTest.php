<?php 
class Model_CategorieOfertaTest extends ControllerTestCase
{
    private $model;
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    /**
     * @var $categorieOferta Application_Model_CategorieOferta
     */
    private $categorieOferta;
    
    public function setUp()
    {
        parent::setUp();
        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
        //$this->em = Front_Api_Util_Bootstrap::getResource('Entitymanagerfactory');
        /**
         * @var $model Application_Model_CategorieOferta
         */
        $model = new Application_Model_CategorieOferta;
        $model->setNume('Litoral');
        $this->model = $model;
    }
 
    public function testCanPersist()
    {
        
        $this->_em->persist($this->model);
        $this->_em->flush();

        $categorieOferta = $this->_em->getRepository('Application_Model_CategorieOferta')->findOneByNume('Litoral');
        $this->assertNotNull($categorieOferta,"Nu a fost gasita nici o categorie avand numele litoral");
        
        return $categorieOferta;
    }
	/**
     * @depends testCanPersist
     */    
    public function testCanReadFromRepository(Application_Model_CategorieOferta $categorieOferta)
    {
        $this->assertEquals($categorieOferta->getNume(),'Litoral');
    }
    
    public function tearDown() {
    	$this->_em->remove($this->model);
    	$this->_em->flush();
    }
}