<?php

require_once '../application/models/Imagine.php';
require_once '../application/models/CategorieOferta.php';
require_once '../application/models/Destinatie.php';

class Model_CircuitTest extends ControllerTestCase
{
    
    /**
     * @var $em \Doctrine\ORM\EntityManager
     */
    private $_em;
    /**
     * @var $categorieOferta Application_Model_CategorieOferta
     */
    private $categorieOferta;
    
    /**
     * 
     * @var Application_Model_Circuit
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
        $c = $this->_em->getRepository('Application_Model_CategorieOferta')->findOneByNume('Revelion');
        $d = $this->_em->getRepository('Application_Model_Destinatie')->findOneByNume($this->destinatieNume);
        
        $date = new DateTime("now");
        $dataAdaugare = clone $date;
        $dataAdaugare->add(new DateInterval('P10M'));

        $this->model->setDataAdaugare($date);
        $this->model->setDataValabilitate($dataAdaugare);
        $this->model->setDescriere('Descriere');
        $this->model->setNume('Test circuit nume\'');
        $this->model->setCategorieOferta($c);
        $this->model->setPret('23.23');
        
        $imagine1 = new Application_Model_Imagine('xx.jpg');
        $imagine2 = new Application_Model_Imagine('yy.jpg');
        
        $this->model->adaugaImagine($imagine1);
        $this->model->adaugaImagine($imagine2);
        
        
        $this->assertNotNull($d);    
        $this->assertNotNull($d,"Destinatia {$this->destinatieNume} nu a fost gasita");
               
        $this->model->setOperator(null);
        $this->_em->persist($this->model);
        $this->_em->flush();
        
        $circuitAdaugat = $this->_em->getRepository('Application_Model_Circuit')->findOneByNume('Test circuit nume\'');
        $this->assertNotNull($circuitAdaugat,'NU s-a putut insera un circuit');
        */
    }
    
    public function ttestAdaugareImagini()
    {
        $numePoze = array('xx.jpg','yy.jpg');
        $circuit = $this->_em->getRepository('Application_Model_Circuit')->findOneById($this->model->getId());
        $imagini = $circuit->getImagini();
        /** @var $imagine Application_Model_Imagine */
        
        $this->assertEquals($imagini[0]->getNume(),$numePoze[0]);
        $this->assertEquals($imagini[1]->getNume(),$numePoze[1]);
    }
 
    public function ttestModelValuesPopulated()
    {
        $this->assertEquals('Revelion',$this->model->getCategorieOferta()->getNume());
        $this->assertContains('2010',$this->model->getDataAdaugare()->format('Y'));
        $this->assertContains('2011',$this->model->getDataValabilitate()->format('Y'));
        $this->assertEquals('23.23',$this->model->getPret(),'Pret');    
    }
	
    public function testValuesReadFromDatabase()
    {
        $circuit = $this->_em->getRepository('Application_Model_Circuit')->findOneById(8);
        $this->assertNotNull($circuit);
       
    }
    
    public function testCanAddDestinatie()
    {
       /** @var $circuit Application_Model_Circuit */
       $circuit = $this->_em->getRepository('Application_Model_Circuit')->findOneById(8);
       
       $destinatii = $circuit->getDestinatii();

       $this->assertEquals($this->destinatieNume,$destinatii[0]->getNume());
    }
    
    public static function dataForSetDataMethodTest()
    {
        return array(
        
            array('data' =>  array (
                                    'nume' => 'TestOK',
                                    'imagini' => array(new Application_Model_Imagine('xx.jpg'),new Application_Model_Imagine('yy.jpg')),
                                    'operator' => null,
                                    'categorieOferta' => new Application_Model_CategorieOferta('Revelion'),
                                    'descriere' => 'descriere')
                   ),
              
            // data with incorrect model values; should fail    
            array('data' =>  array (
                                    'nume' => 'TestBroken',
                                    'imagini' => 'x',
                                    'operatmor' => null,
                                    'categorieOferta' => new Application_Model_CategorieOferta('Revelion'),
                                    'descripere' => 'descriere')        
                    )
        
            );
    }
    /**
	 * @dataProvider dataForSetDataMethodTest 
     */
    public function testCanSetDataWithValidValues($data)
    {
        try {
        $sejur = new Application_Model_Circuit();
        $sejur->setData($data);
        
        $this->assertGreaterThan(0,strlen($sejur->getNume()));
        $this->assertEquals(2,count($sejur->getImagini()));
        $this->assertType('Application_Model_CategorieOferta',$sejur->getCategorieOferta());
        $this->assertNull($sejur->getOperator());
        $i = $sejur->getImagini();
        $this->assertContainsOnly('Application_Model_Imagine',$i);
        $this->assertNotNull($i[0]);
        $this->assertEquals('xx.jpg',$i[0]->getNume());
        } catch (Application_Model_Exception $e)
        {
            echo "OK: Exception caught. ".$e->getMessage();
            return;
        }
        
        unset($data);
        unset($i);
        unset($sejur);
    }

    
	/**
     * @depends testCanPersist
     */    
  //  public function testCanReadFromRepository(Application_Model_CategorieOferta $categorieOferta)
    //{
        //$this->assertEquals($categorieOferta->getNume(),'Litoral');
   // }
    
    public function tearDown() {
         $this->_em->remove($this->model);
         $this->_em->flush();
    }
}