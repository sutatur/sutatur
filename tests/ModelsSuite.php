<?php
require_once 'models\DestinatieTest.php';
require_once 'application\ControllerTestCase.php';
/**
 * Static test suite.
 */
class ModelsSuite extends PHPUnit_Framework_TestSuite
{
    protected function setUp()
    {
        print "\nModel Suite";
    }    
    /**
     * Constructs the test suite handler.
     */
    public function __construct ()
    {
        $this->setName('testsSuite');
        $this->addTestSuite('Model_DestinatieTest');
    }
    /**
     * Creates the suite.
     */
    public static function suite ()
    {
        return new self();
    }
}

