<?php

use Doctrine\ORM\EntityRepository;

class Application_Model_RepositoryDestinatie extends EntityRepository
{
    /**
     * @param Application_Model_Destinatie $circuit
     */
    public function getImagini(Application_Model_Destinatie $destinatie)
    {
        $id = $destinatie->getId();
        $dql = "SELECT c,i FROM Application_Model_Destinatie c JOIN c.imagini i WHERE c.id= ?1";
        /** @var $circuite Application_Model_Destinatie */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();
        return $circuite[0]->getImagini();
    }
    
    /**
     * @param Application_Model_Destinatie $circuit
     */
    public function getDestinatii(Application_Model_Destinatie $destinatie)
    {
        $id = $destinatie->getId();
        $dql = "SELECT c,d FROM Application_Model_Destinatie c JOIN c.destinatii d WHERE c.id= ?1";
        /** @var $circuite Application_Model_Destinatie */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();

        return $circuite[0]->getDestinatii();
    }
    
    public function getListaTari()
    {
        $dql = 'SELECT d FROM Application_Model_Destinatie d WHERE d.tara is null';
        return $this->_em->createQuery($dql)->getArrayResult();
    }
    
    public function getListaDestinatiiTara($taraId = '')
    {
        $dql = 'SELECT d.id,d.nume from Application_Model_Destinatie d WHERE d.tara = ?1';
        return $this->_em->createQuery($dql)->setParameter(1,$taraId)->getArrayResult();
    }
}