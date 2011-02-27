<?php
use Doctrine\ORM\EntityRepository;


class Application_Model_RepositoryOferta extends EntityRepository implements Application_Model_Repository
{
    /**
     * @param Application_Model_Oferta_Circuit $circuit
     */
    public function getImaginiCircuit(Application_Model_Oferta_Circuit $circuit)
    {
        $id = $circuit->getId();
        $dql = "SELECT c,i FROM Application_Model_Oferta_Circuit c JOIN c.imagini i WHERE c.id= ?1";
        /** @var $circuite Application_Model_Oferta_Circuit */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();

        return $circuite[0]->getImagini();
    }
    
    /**
     * @param Application_Model_Oferta_Circuit $circuit
     */
    public function getDestinatiiCircuit(Application_Model_Oferta_Circuit $circuit)
    {
        $id = $circuit->getId();
        $dql = "SELECT c,d FROM Application_Model_Oferta_Circuit c JOIN c.destinatii d WHERE c.id= ?1";
        /** @var $circuite Application_Model_Oferta_Circuit */
        $circuite = $this->_em->createQuery($dql)
                         ->setParameter(1, $id)
                         ->getResult();

        return $circuite[0]->getDestinatii();
    }

    public function getListaCategoriiOferta()
    {
         $categoriiOferta = $this->_em->getRepository('Application_Model_CategorieOferta')->createQueryBuilder('c');
         return $categoriiOferta->getQuery()->getArrayResult();
    }
    
     protected function populateModel(Application_Model_Abstract $model)
    {
       if ( isset($this->data['categorieOferta']))
       {
            $categorieOferta = $this->_em->find('Application_Model_CategorieOferta',$this->data['categorieOferta']);
            if (is_null($categorieOferta))
                throw new Application_Model_Exception('Oferta categorie cu id: '.$this->data['categorieOferta'].' nu a fost gasita');
            $this->data['categorieOferta'] = $categorieOferta;
       }
        
        if ( isset($this->data['dataValabilitate']))
        {
            $dataValabilitate = new \DateTime($this->data['dataValabilitate']);
            $this->data['dataValabilitate'] = $dataValabilitate;
        }
        
        if ( isset($this->data['destinatie']))
        {
            $destinatie = $this->_em->find('Application_Model_Destinatie',$this->data['destinatie']);
            if (is_null($destinatie))
                throw new Application_Model_Exception('Destinatia cu id: '.$this->data['destinatie'].' nu a fost gasita');            
            $this->data['destinatie'] = $destinatie;
        }
        $model->populate($this->data);
    }    
    
    public function save(Application_Model_Entity $model)
    {
        $this->_em->persist($model);
    }
}