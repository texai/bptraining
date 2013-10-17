<?php

namespace Application\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\TableGateway\TableGateway;

class Pago extends TableGateway{
    
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('pago', $adapter, $databaseSchema, $selectResultPrototype);
    }
    
    public function insertarpago($form){
        $data = array(
            'monto' => $form['monto'],
            'tipo'  => $form['tipo'],
            'estado'  => 'valido',
            'fecha_pago'  => $form['fecha'],
            'idCompra'  => $form['id'],
        );
        $this->insert($data);
        $idPago = $this->getLastInsertValue();
        return $idPago;
    }
}

?>
