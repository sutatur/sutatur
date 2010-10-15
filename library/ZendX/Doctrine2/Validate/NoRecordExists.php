<?php
/**
 * @see ZendX_Doctrine2_Validate_Abstract
 */
require_once 'ZendX/Doctrine2/Validate/Abstract.php';

/**
 * Confirms a record does not exist in a table.
 *
 * @category   Zend
 * @package    ZendX_Doctrine
 * @uses       ZendX_Doctrine_Validate_Abstract
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class ZendX_Doctrine2_Validate_NoRecordExists extends ZendX_Doctrine2_Validate_Abstract
{
    public function isValid($value)
    {
        $valid = true;
        $this->_setValue($value);

        $result = $this->_query($value);
        if ($result) {
            $valid = false;
            $this->_error(self::ERROR_RECORD_FOUND);
        }

        return $valid;
    }
}
