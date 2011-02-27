<?php 
use application\models\Application_Model_Repository;
class Model_CategorieOfertaTest extends PHPUnit_Framework_TestCase
{
    private $model;
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private  $_em;
    
    /**
     * @var $repository Application_Model_Repository
     */
    private $repository;
    /**
     * @var $categorieOferta Application_Model_CategorieOferta
     */
    private $categorieOferta;
    
    public function setUp()
    {
        $this->application = new Zend_Application(APPLICATION_ENV,
              APPLICATION_PATH . '/configs/application.ini'
        );
        $this->application->bootstrap('Entitymanagerfactory');
        
        /**
         * @var $model Application_Model_CategorieOferta
         */
        $model = new Application_Model_Oferta_CategorieOferta();
        
        $model->setNume('Litoral');
        $this->model = $model;
        
        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
        $this->repository = new Application_Model_Oferta_RespositoryCategorieOferta($this->_em); 
    }
 
    public function testCanSave()
    {
        
        $this->repository->save($this->model);
        $this->_em->flush();

        $categorieOferta = $this->_em->getRepository('Application_Model_Oferta_CategorieOferta')->findOneByNume('Litoral');
        $this->assertNotNull($categorieOferta,"Nu a fost gasita nici o categorie avand numele litoral");
        
        return $categorieOferta;
    }
	/**
     * @depends testCanSave
     */    
    public function testCanReadFromRepository(Application_Model_Oferta_CategorieOferta $categorieOferta)
    {
        $this->assertEquals($categorieOferta->getNume(),'Litoral');
    }
    
    public function tearDown() {
    	$this->_em->remove($this->model);
    	$this->_em->flush();
    }
}