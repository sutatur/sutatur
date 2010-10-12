<?php
/**
 * @throws Application_Service_Exception
 * @author angel
 *
 */
use Doctrine\ORM;
use \Doctrine\ORM\ORMException;

class Application_Service_Oferta extends Application_Service_Abstract implements Zend_Acl_Resource_Interface
{
    const MODEL_CLASS_SEJUR = 'Application_Model_Sejur';
    const MODEL_CLASS_CIRCUIT = 'Application_Model_Circuit';
    
    /**
     * @var Zend_Authentication
     */
    private $auth;
    
    /**
     * @var string
     */
    private $ofertaTip;
    
    function __construct($ofertaTip = null)
    {
        $this->modelClass = $ofertaTip == 'circuit' ?  self::MODEL_CLASS_CIRCUIT : self::MODEL_CLASS_SEJUR;
        $this->ofertaTip = $ofertaTip;
        parent::__construct();
    }
    
    
	/**
     * @param $data the $data to set
     */
    public function setData ($data)
    {
        $this->data = $data;
    }

    public function getData ()
    {
        return $this->data;
    }    

	/**
     * @return the $ofertaTip
     */
    public function getOfertaTip ()
    {
        return $this->ofertaTip;
    }

	/**
     * @param $ofertaTip the $ofertaTip to set
     */
    public function setOfertaTip ($ofertaTip)
    {
        $this->ofertaTip = $ofertaTip;
    }
	/**
     * @return the $model
     */
    public function getModel ()
    {
        return $this->modelClass;
    }
    
    public function saveOferta()
    {
        if ($this->checkAcl('save'))
            throw new Application_Service_Exception('Drepturi insuficiente');
        
        /** @var $form Zend_Form */    
        $form = $this->getForm('Oferta'.ucfirst($this->ofertaTip));
 
        if (!$form->isValid($this->data)) {
            return false;
        }

        $this->modelClass->setData($this->data);
        /*
        if ($form->getValue('id')) {
            $id = $form->getValue('id');
            $this->dao->persist($form->getValues(), $id));
        } else {
            $id = $storage->insert($form->getValues());
        }
          */ 
        $data = $this->data;
        $updating = false;
        
        $modelClass = $this->modelClass;
        
        /** 
         * @var $model Application_Model_Oferta 
         */
        $model = null;
                
        if ( isset($data['id']) && (int)$data['id'] > 0)
        {
            $ofertaId = $data['id'];
            $model = $this->dao->find($this->modelClass,$ofertaId);
            $this->logger->log('Updating oferta '.$data['id'].'...',ZEND_LOG::DEBUG);    
            if (!$model)
                throw new Application_Service_Exception('Oferta cu id '.$data['id']. 'nu a fost gasita pt actualizare');
            
            $updating = true;   
        } else {
            $model = new $this->modelClass;
        }

        $this->dao->persist($model);
           
        // verifica daca categoria si destinatia exista 
        // validarea se va face cu zend_form
        /*
        if (($updating && isset($data['categorieOferta'])) || !$updating)
        {
            
            $categorie = $this->dao->getRepository('Application_Model_CategorieOferta')->findOneById($data['categorieOferta']);
            if (is_null($categorie))
         	    throw new Application_Service_Exception('Nu a fost gasita categoria');
        }

        if (($updating && isset($data['destinatie'])) || !$updating)
        {
            $destinatie = $this->dao->getRepository('Application_Model_Destinatie')->findOneById($data['destinatie']);
            if (is_null($destinatie))
         	    throw new Application_Service_Exception('Nu a fost gasita destinatia ID:'. $data['destinatie']);
        }
        */
        $model->setData($this->data);        
           
        try {
            $this->dao->flush();
        } catch (ORMException $e) {
            throw new Application_Service_Exception ($e->getMessage());
        }
            
        
        unset($data);
        
        return $updating==true ? true : $model->getId();
    }
    
    /**
     * @param integer $oferta
     */
    public function deleteOferta($id)
    {
        $this->modelClass = $this->dao->find('Application_Model_Oferta',$id);
        if (is_null($this->modelClass))
            throw new Application_Service_Exception('Oferta cu id: '.$id.' nu a fost gasita'); 
        try {
    	    $this->dao->remove($this->modelClass);
    	    $this->dao->flush();
        }
        catch (ORMException $e)
        {
            throw new Application_Service_Exception('Nu am putut sterge oferta cu id: '.$id.';\n '.$e->getMessage());
        }
        return true;
    }

    public function getListaCategoriiOferta()
    {
         $categoriiOferta = $this->dao->getRepository('Application_Model_CategorieOferta')->createQueryBuilder('c');
         return $categoriiOferta->getQuery()->getArrayResult();
    }
    
    
    public function getResourceId()
    {
        return 'oferta';
    }
}
?>