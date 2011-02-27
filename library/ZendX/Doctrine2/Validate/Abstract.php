<?php 

/**
 * @see Zend_Validate_Db_Abstract
 */
use \Doctrine\ORM\EntityManager;
require_once 'Zend/Validate/Db/Abstract.php';

/**
 * @uses Zend_Validate_Db_Abstract
 */
abstract class ZendX_Doctrine2_Validate_Abstract extends Zend_Validate_Db_Abstract
{
    /**
     * Sets a new database adapter
     *
     * @param  \Doctrine\ORM\EntityManager $adapter
     * @return ZendX_Doctrine2_Validate_Abstract
     */
    public function setAdapter($adapter)
    {
        if (!($adapter instanceof EntityManager)) {
            require_once 'Zend/Validate/Exception.php';
            throw new Zend_Validate_Exception('Adapter option must be a Doctrine2 Entity Manager!');
        }

        $this->_adapter = $adapter;
        return $this;
    }

     /**
     * Sets the value to be validated and clears the messages and errors arrays
     *
     * @param  mixed $value
     * @return void
     * @see Zend_Validate_Db_Abstract
     */
    protected function  _setValue($value)
    {
       if (is_object($value))
           $value = $value->getId();     
        
        parent::_setValue($value);
    }    
    /**
     * Run query and returns matches, or null if no matches are found.
     *
     * @param  String $value
     * @return Array when matches are found.
     */
    protected function _query($value)
    {
        /**
         * Check for an adapter being defined. if not, fetch the default adapter.
         */
        if ($this->_adapter === null) {
            $this->_adapter = Zend_Registry::get('em');
            if (null === $this->_adapter) {
                require_once 'Zend/Validate/Exception.php';
                throw new Zend_Validate_Exception('No em registry key found');
            }
        }

        /**
         * Build select object
         */
       $qb = $this->_adapter->createQueryBuilder()
            ->select('e.' . $this->_field )
            ->from($this->_table, 'e')
            ->where('e.' . $this->_field . ' = ?1');
        
         try {
        $result = $qb->getQuery()
                    ->setParameter(1,$value)
                    ->setMaxResults(1)
                    ->getSingleScalarResult();
         }
         catch (\Doctrine\ORM\NoResultException $e)
         {
             return false;
         }            
        return $result;
    }     
}