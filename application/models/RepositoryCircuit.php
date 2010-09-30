<?php

use Doctrine\ORM\EntityRepository;

class Application_Model_RepositoryCircuit extends EntityRepository
{
    /**
     * @param Application_Model_Circuit $circuit
     */
    public function getImagini(Application_Model_Circuit $circuit)
    {
        $id = $circuit->getId();
        $dql = "SELECT c,i FROM Application_Model_Circuit c JOIN c.imagini i WHERE c.id= ?1";
        /** @var $circuite Application_Model_Circuit */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();
        return $circuite[0]->getImagini();
    }
    
    /**
     * @param Application_Model_Circuit $circuit
     */
    public function getDestinatii(Application_Model_Circuit $circuit)
    {
        $id = $circuit->getId();
        $dql = "SELECT c,d FROM Application_Model_Circuit c JOIN c.destinatii d WHERE c.id= ?1";
        /** @var $circuite Application_Model_Circuit */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();

        return $circuite[0]->getDestinatii();
            }
}