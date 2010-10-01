<?php 
class Model_SejurTest extends ControllerTestCase
{
    
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    
    
    /**
     * 
     * @var Application_Model_Sejur
     */
    private $model;
    
    private $destinatieNume = 'Suceava';
    public function setUp()
    {
        parent::setUp();
        if (!$this->_em) $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');
        //$this->em = Front_Api_Util_Bootstrap::getResource('Entitymanagerfactory');
        
        $this->model = new Application_Model_Circuit();
        //$categorieOferta = new Application_Model_CategorieOferta();
        
        //$categorieOferta->setId(5);
        // 
        //$c = new Application_Model_CategorieOferta();
        //$c->setId(3);
        //$c->setNume('teswt');
        /*
                */
    }
    
    public function testAdaugareImagini()
    {
        $this->_setUpModel();
        $numePoze = array('xx.jpg','yy.jpg');
        $circuit = $this->_em->getRepository('Application_Model_Sejur')->findOneById($this->model->getId());
        $imagini = $circuit->getImagini();
        /** @var $imagine Application_Model_Imagine */
        
        $this->assertEquals($imagini[0]->getNume(),$numePoze[0]);
        $this->assertEquals($imagini[1]->getNume(),$numePoze[1]);
    }
 
    
    public function testCanAddDestinatie()
    {
       /** @var $circuit Application_Model_Circuit */
       $d = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume($this->destinatieNume);        
       $this->assertNotNull($d,"Destinatia {$this->destinatieNume} nu a fost gasita");
        
       $this->_setUpModel();
              
       $this->model->setDestinatie($d);
       $this->_em->flush();
       /**
        * @var $sejur Application_Model_Sejur
        */
       $sejur = $this->_em->getRepository('Application_Model_Sejur')->findOneById($this->model->getId());
       $destinatie = $sejur->getDestinatie();

       $this->assertEquals($this->destinatieNume,$destinatie->getNume());
    }
	/**
     * @depends testCanPersist
     */    
  //  public function testCanReadFromRepository(Application_Model_CategorieOferta $categorieOferta)
    //{
        //$this->assertEquals($categorieOferta->getNume(),'Litoral');
   // }
    public function testCanPersist()
    {
        $circuitAdaugat = $this->_em->getRepository('Application_Model_Sejur')->findOneByNume('Test sejur nume\'');
        $this->assertNotNull($circuitAdaugat,'NU s-a putut insera un sejur');
        
    }
    
    private function _setUpModel()
    {
        /**
         * @var Application_Model_Sejur
         */ 
        $this->model = new Application_Model_Sejur();

        $c = $this->_em->getRepository('Application_Model_CategorieOferta')->findOneByNume('Revelion');

        
        $date = new DateTime("now");
        $dataAdaugare = clone $date;
        $dataAdaugare->add(new DateInterval('P10M'));

        $this->model->setDataValabilitate($dataAdaugare);
        $this->model->setDescriere('Descriere');
        $this->model->setNume('Test sejur nume\'');
        $this->model->setCategorieOferta($c);
        $this->model->setPret('999.32');
        
        $imagine1 = new Application_Model_Imagine('xx.jpg');
        $imagine2 = new Application_Model_Imagine('yy.jpg');
        
        $this->model->adaugaImagine($imagine1);
        $this->model->adaugaImagine($imagine2);
        
        $this->model->setOperator(null);

        $this->_em->persist($this->model);
        $this->_em->flush();
                
    }

    public function tearDown() {
         $this->_em->remove($this->model);
         $this->_em->flush();
    }
}