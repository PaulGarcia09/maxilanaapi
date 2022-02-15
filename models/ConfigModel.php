<?php

namespace Maxilana\MaxilanaApp\Models;

use Phalcon\Mvc\Model as Modelo;

class ConfigModel extends Modelo
{
    public function GrabarContacto($Correo,$Asunto,$Problema)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_Contacto :Correo,:Asunto,:Problema");
        $statement->bindParam(":Correo",      $Correo,      \PDO::PARAM_STR);
        $statement->bindParam(":Asunto",      $Asunto,      \PDO::PARAM_STR);
        $statement->bindParam(":Problema",    $Problema,    \PDO::PARAM_STR);
        $statement->execute();
        return $response;
    }

}