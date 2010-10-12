<?php
/**
 * @see Zend_Doctrine2_Validate_Abstract
 */
require_once 'ZendX/Doctrine2/Validate/Abstract.php';

/**
 * Confirms a record exists in a table.
 * 
 * @uses       ZendX_Doctrine2_Validate_Abstract
 * @author 	   angel
 */
class ZendX_Doctrine2_Validate_RecordExists extends ZendX_Doctrine2_Validate_Abstract
{
    public function isValid($value)
    {
        $valid = true;
        $this->_setValue($value);

        $result = $this->_query($value);
        if (!$result) {
            $valid = false;
            $this->_error(self::ERROR_NO_RECORD_FOUND);
        }

        return $valid;
    }
}
