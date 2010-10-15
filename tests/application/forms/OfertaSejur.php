<?php
require_once 'PHPUnit\Framework\TestCase.php';
/**
 * Application_Service_Oferta test case.
 * @group Application_Form
 */
class Application_Form_OfertaSejurTest extends ControllerTestCase
{

    /**
     * @var Zend_Form
     */
    private $form;
    
    /**
     * Prepares the environment before running a test.
     */
    public function setUp ()
    {
        parent::setUp();
        $this->form = new Application_Form_OfertaSejur();
    }
    
    public function testConstructor()
    {
        /** @var Zend_Form_Element */
        $destinatii = $this->form->getElement('destinatie')->getValue();
        var_dump($this->form->getElement('destinatie')->render());
        //$this->assertArrayHasKey('Romania',$destinatii);
    }
        /**
     * Cleans up the environment after running a test.
     */
    function tearDown ()
    {
        // TODO Auto-generated Application_Form_OfertaSejurTest::tearDown()
        $this->Application_Form_OfertaSejur = null;
        parent::tearDown();
    }
    
    /**
     * Constructs the test case.
     */ 
    function __construct ()
    {// TODO Auto-generated constructor
}
}

