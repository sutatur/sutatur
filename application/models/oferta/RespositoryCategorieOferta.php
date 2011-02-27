<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;


class Application_Model_Oferta_RespositoryCategorieOferta extends EntityRepository implements Application_Model_Repository
{
    public function save(Application_Model_Entity $model)
    {
        $this->_em->persist($model);
    }
    
    public function __construct(EntityManager $em)
    {
        $this->_em = $em;
    }
}
?>