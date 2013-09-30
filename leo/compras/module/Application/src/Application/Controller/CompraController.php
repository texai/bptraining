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
use Zend\Db\Adapter\Adapter;
use Application\Model\Compra;


class CompraController extends AbstractActionController
{
    public $dbAdapter;
    
    public function indexAction()
    {
        return new ViewModel();
    }

    public function getdataAction(){
        $form =$this->getRequest()->getPost('form');
        $this -> dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter');
        $o_compra = new Compra($this->dbAdapter);
        $o_compra->guardarCompra($form);
        //print_r($form['divisa']);die();
        return $this->getResponse();
    }
}
