<?php
use Doctrine\ORM;
//require_once ('application\services\Abstract.php');
/** 
 * @author angel
 * @throws Application_Service_Exception 
 * 
 */
class Application_Service_Destinatie extends Application_Service_Abstract
{
    const MODEL_CLASS = 'Application_Model_Destinatie';

    public function getListaTari()
    {
        $tari = $this->dao->getRepository($this->modelClass)->getListaTari();
        return $tari;
    }
    
    public function getListaDestinatiiTara($taraId = '')
    {
        if ($taraId === '')
            return;
        else
            return $this->dao->getRepository($this->modelClass)->getListaDestinatiiTara($taraId);
    }
    
    protected function populateModel(Application_Model_Abstract $model)
    {
        $model->populateData();
    }

}
?>