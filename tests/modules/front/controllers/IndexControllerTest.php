<?php

require_once 'Zend\Test\PHPUnit\ControllerTestCase.php';
/**
 * IndexController test case.
 */
class Modules_Front_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    /**
     * Prepares the environment before running a test.
     */
    public function setUp()
    {
        parent::setUp();
    }
    /**
     * Tests IndexController->indexAction()
     */
    public function testCallWithoutActionShouldPullFromIndexAction ()
    {
        $this->dispatch('/');
        $this->assertController('index');
        $this->assertModule('front');
        $this->assertAction('index');    
    }
}

