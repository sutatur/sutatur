<?php 
/**
    @author Angel <angel@sutalsutaturism.ro>
*/

class SutaTurism_Controller_Plugin_LayoutSwitcher extends Zend_Layout_Controller_Plugin_Layout
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $moduleName = $request->getModuleName();
        $this->getLayout()->setLayout($moduleName);
    }
}