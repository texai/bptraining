<?php

namespace Application\Model;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class Compra extends TableGateway{
        
     public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('compra', $adapter, $databaseSchema, $selectResultPrototype);
    }

    public function guardarCompra($form){
        $data = array(
            'monto_total' => $form['monto_t'],
            'monto_pagado'  => $form['monto_p'],
            'fecha_compra'  => $form['fecha_c'],
            'fecha_vencimiento_pago'  => $form['fecha_v'],
            'divisa'  => $form['divisa'],
        );
        $this->insert($data);
    }
    
    public function getDataCompra(){
        $data = $this->select()->toArray();
        return $data;
    }
    
    public function actualizarmonto($form) {
        $row = $this->select(array('idCompra' => $form['id']))->current();
        $row['monto_pagado'] = $row['monto_pagado'] + $form['monto'];
        $data = array(
            'monto_pagado' => $row['monto_pagado']
        );
        $this->update($data, array('idCompra' => $form['id']));
        
        return $row['fecha_vencimiento_pago'];
    }
    
}
?>
