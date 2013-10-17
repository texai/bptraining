<?php

namespace Application\Model;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;

class notificacion extends TableGateway{
    
    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResultSet $selectResultPrototype = null)
    {
        return parent::__construct('notificacion', $adapter, $databaseSchema, $selectResultPrototype);
    }
    
    public function insertar($idpago,$estado){
        $data = array(
            'estado'=>$estado,
            'fecha_hora'=> date('Y-m-d H:i:s'),
            'idPago'=>$idpago
        );
        $this->insert($data);
    }
    
}


?>
