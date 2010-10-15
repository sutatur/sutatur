<?php
/**
 * PHPUnit_Framework_TestCase
 */
require_once 'PHPUnit/Framework/TestCase.php';


/**
 * @see ZendX_Doctrine_Validate_Abstract.php
 */
require_once 'ZendX/Doctrine2/Validate/Abstract.php';

require_once 'ZendX/Doctrine2/Validate/NoRecordExists.php';

/**
 * @category   ZendX
 * @package    ZendX_Doctrine2
 * @subpackage UnitTests
 * @group      ZendX_Doctrine2
 */
class Zend_Validate_Db_NoRecordExistsTest extends ControllerTestCase
{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $_em;

    /**
     * @var Zend_Db_Adapter_Abstract
     */
    protected $_adapterNoResult;

    /**
     * Set up test configuration
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->_em = $this->application->getBootstrap()->getResource('Entitymanagerfactory');

    }
    
    /**
     * Test basic function of RecordExists (no exclusion)
     *
     * @return void
     */
    public function testBasicFindsRecord()
    {
        $validator = new ZendX_Doctrine2_Validate_NoRecordExists(array('table' => 'Application_Model_CategorieOferta', 'field' => 'nume', 'adapter' => $this->_em));
        $this->assertFalse($validator->isValid('Revelion'));
    }

    /**
     * Test basic function of RecordExists (no exclusion)
     *
     * @return void
     */
    public function testBasicFindsNoRecord()
    {
        $validator = new ZendX_Doctrine2_Validate_NoRecordExists(array('table' => 'Application_Model_CategorieOferta', 'field' => 'nume', 'adapter' => $this->_em));
        $this->assertTrue($validator->isValid('nosuchvalue'));
    }
}
