<?php
require_once 'PHPUnit\Framework\TestCase.php';
/**
 * Application_Service_Oferta test case.
 */
class Application_Service_OfertaTest extends ControllerTestCase
{

    /**
     * @var Application_Service_Oferta
     */
    private $Application_Service_Oferta;
    
    /**
     * Prepares the environment before running a test.
     */
    public function setUp ()
    {
        parent::setUp();
        $this->Application_Service_Oferta = new Application_Service_Oferta('sejur');
    }
    
    public function testConstructor()
    {
        $this->assertContains('Sejur',$this->Application_Service_Oferta->getModel());
    }
    public function testSetData ()
    {
        $this->Application_Service_Oferta->setData(array('nume'=>'x'));
        $this->assertArrayHasKey('nume',$this->Application_Service_Oferta->getData());
    }
    
    /**
     * @expectedException Application_Service_Exception
     */
    public function testDestinatieNuExista()
    {
        $data['categorieOferta'] = 22;
        $data['destinatie'] = 40;
        $this->Application_Service_Oferta->setData($data);
        $this->Application_Service_Oferta->saveOferta();
    }
	    

    public static function dataForSaveOferta()
    {
        return array(
        
            array('data' =>  array (
                                    'nume' => 'TestOK',
                                    'imagini' => array(new Application_Model_Imagine('xx.jpg'),new Application_Model_Imagine('yy.jpg')),
                                    'operator' => null,
                                    'categorieOferta' => new Application_Model_CategorieOferta('Revelion'),
                                    'descriere' => 'descriere')
                   )
             );
    }
    
	/**
     * @dataProvider dataForSaveOferta
     */    
    public function testCreareOferta ()
    {
        
        /*
        
        $data['pret'] = 99.99;
        $data['nume'] = 'Test adaugare service sejur';
        $data['descriere'] = 'Test Descriere'; 
        $data['imagini'] = array(new Application_Model_Imagine('1.jpg'),new Application_Model_Imagine('2.jpg'));
        */
        $date = new DateTime("now");
        
        $dataAdaugare = clone $date;
        $dataAdaugare->add(new DateInterval('P10M'));
        $data['nume'] = 'Nume oferta';
        $data['categorieOferta'] = 2;
        $data['destinatie'] = 2;
        $data['tara'] = 99;
        $data['valabilitate'] = '2010-10-12';
        $data['descriere'] = 'Descriere';
        //$data['valabilitate'] = $dataAdaugare;
        
        
        $this->Application_Service_Oferta->setData($data);
        $id = $this->Application_Service_Oferta->saveOferta();
        
        var_dump($this->Application_Service_Oferta->getForm('OfertaSejur')->getMessages());
        $this->assertGreaterThan(0,$id);
        
        return $id;
    }
    
    /**
     * @depends testCreareOferta
     * @param integer $id
     */
    public function testUpdateOferta($id)
    {
        $data['id'] = $id;
        $data['nume'] = 'Oferta modificata';
        $this->Application_Service_Oferta->setData($data);
        $result = $this->Application_Service_Oferta->saveOferta();
        $this->assertTrue($result);
    }
    /**
     * @depends testSaveOferta
     * @param integer $id
     */
    public function testRemoveOferta($id) {
        
    	//$this->Application_Service_Oferta->deleteOferta($id);
    	
    }
    /**
     * Cleans up the environment after running a test.
     */
    function tearDown ()
    {
        // TODO Auto-generated Application_Service_OfertaTest::tearDown()
        $this->Application_Service_Oferta = null;
        parent::tearDown();
    }
    
    /**
     * Constructs the test case.
     */ 
    function __construct ()
    {// TODO Auto-generated constructor
}
}

