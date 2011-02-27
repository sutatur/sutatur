<?php
/**
 * PHPUnit_Framework_TestCase
 */
require_once 'PHPUnit/Framework/TestCase.php';


/**
 * @see ZendX_Doctrine_Validate_Abstract.php
 */
require_once 'ZendX/Doctrine2/Validate/Abstract.php';

require_once 'ZendX/Doctrine2/Validate/RecordExists.php';

/**
 * @category   ZendX
 * @package    ZendX_Doctrine2
 * @subpackage UnitTests
 * @group      ZendX_Doctrine2
 */
class ZendX_Doctrine2_Validate_RecordExistsTest extends PHPUnit_Framework_TestCase
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
        $validator = new ZendX_Doctrine2_Validate_RecordExists(array('table' => 'Application_Model_CategorieOferta', 'field' => 'nume', 'adapter' => $this->_em));
        $this->assertTrue($validator->isValid('Revelion'));
    }

    /**
     * Test basic function of RecordExists (no exclusion)
     *
     * @return void
     */
    public function testBasicFindsNoRecord()
    {
        $validator = new ZendX_Doctrine2_Validate_RecordExists(array('table'=> 'Application_Model_CategorieOferta' ,'field' => 'nume'));
        $this->assertFalse($validator->isValid('nosuchvalue'));
    }

    /**
     * Test that the class throws an exception if no adapter is provided
     * and no default is set.
     *
     * @return void
     */
    public function testThrowsExceptionWithNoAdapter()
    {

        try {
            $validator = new ZendX_Doctrine2_Validate_RecordExists('Application_Model_CategorieOferta', 'nume', 'id != 1');
            $valid = $validator->isValid('nosuchvalue');

        } catch (Exception $e) {
        }
    }

    /**
     * Test when adapter is provided
     *
     * @return void
     */
    public function testAdapterProvided()
    {
        //clear the default adapter to ensure provided one is used
        try {
            $validator = new ZendX_Doctrine2_Validate_RecordExists('Application_Model_CategorieOferta', 'nume', null, $this->_em);
            $this->assertTrue($validator->isValid('Litoral'));
        } catch (Zend_Exception $e) {
            $this->markTestSkipped('No database available');
        }
    }

    /**
     * Test when adapter is provided
     *
     * @return void
     */
    public function testAdapterProvidedNoResult()
    {
        
        //clear the default adapter to ensure provided one is used
            $validator = new ZendX_Doctrine2_Validate_RecordExists('Application_Model_CategorieOferta', 'nume', null, $this->_em);
            $this->assertFalse($validator->isValid('nimic'));
        
    }

}
