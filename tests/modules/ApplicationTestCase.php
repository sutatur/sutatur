<?php
class Application_ApplicationTest extends ControllerTestCase
{
    public function setUp()
    {
        parent::setUp();
    }
 
    public function testCanSwitchLayout()
    {
        $layoutInstance = Zend_Layout::getMvcInstance();
        $layout = $layout->getLayout()->name;
        
        $this->dispatch('/');
        $this->assertEquals('front',$layout);
        $this->dispatch('/admin');
        $this->assertEquals('adminx',$layout);
    }
}