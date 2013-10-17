<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Model\Pago;
use Application\Model\Compra;
use Application\Model\Notificacion;




class PagoController extends AbstractActionController
{
    public $dbAdapter;
    public function indexAction(){
        
        $this -> dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
        $o_pago = new Compra($this->dbAdapter);
        $a_data = $o_pago->getDataCompra();
        
        $view = new ViewModel();
        $view->datacompra = $a_data;
        return $view;
    }
    
    public function updateAction(){
        
        $this -> dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
        
        $post = $this->getRequest()->getPost('actualizacion');        
        $o_compra = new Compra($this->dbAdapter);
        $fecha_venci = $o_compra->actualizarmonto($post);
        
        $o_pago = new Pago($this->dbAdapter);
        $idpago = $o_pago->insertarpago($post);

        if(strtotime($fecha_venci) >= strtotime($post['fecha']))
            $estado = 'pagado';
        else
            $estado = 'vencido';
        
        $o_notificacion = new Notificacion($this->dbAdapter);        
        $o_notificacion->insertar($idpago,$estado);
//         $this->redirect()->toRoute('default', array(
//                    'controller' => 'Index',
//                    'action'     => 'index',
//                ));
        return $this->getResponse();
       //return $this->response->setContent(json_encode(array($fecha_venci)));
    }
}
