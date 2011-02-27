<?php

require_once 'Zend\Test\PHPUnit\ControllerTestCase.php';
/**
 * IndexController test case.
 */
class Modules_Admin_IndexControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
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
        $this->dispatch('/admin');
        $this->assertController('index');
        $this->assertModule('admin');
        $this->assertAction('index');    
    }
 
    public function notestCanSwitchLayout()
    {
        $bootstrap  = $this->application->getBootstrap();
        /**
         * @var $layout Zend_Layout
         */
        $layout = $bootstrap->getResource('layout');
        
        $layoutName = $layout->getLayout();
        
        
        $this->dispatch('/admin');
        $this->assertEquals('adminx',$layoutName);
        $this->dispatch('/');
        $this->assertEquals('front',$layoutName);
        
    }    
}

