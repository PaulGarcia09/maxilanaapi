<?php

namespace Maxilana\MaxilanaApp\Models;

use Phalcon\Mvc\Model as Modelo;

class RegistroModel extends Modelo
{
    public function RegistroUsuario($ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_AltaClientesAPP :ApellidoP,:ApellidoM,:Nombre,:Celular,:Correo,:Contrasena");
        $statement->bindParam(":ApellidoP",      $ApellidoP,      \PDO::PARAM_STR);
        $statement->bindParam(":ApellidoM",      $ApellidoM,      \PDO::PARAM_STR);
        $statement->bindParam(":Nombre",         $Nombre,         \PDO::PARAM_STR);
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->bindParam(":Correo",         $Correo,         \PDO::PARAM_STR);
        $statement->bindParam(":Contrasena",     $Contrasena,     \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Usuario =  $entry["CodigoUsuario"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        
        return $response;
    }
    public function EditarUsuario($Usuario,$ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_EditarClientesAPP :Usuario,:ApellidoP,:ApellidoM,:Nombre,:Celular,:Correo,:Contrasena");
        $statement->bindParam(":Usuario",      $Usuario,      \PDO::PARAM_INT);
        $statement->bindParam(":ApellidoP",      $ApellidoP,      \PDO::PARAM_STR);
        $statement->bindParam(":ApellidoM",      $ApellidoM,      \PDO::PARAM_STR);
        $statement->bindParam(":Nombre",         $Nombre,         \PDO::PARAM_STR);
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->bindParam(":Correo",         $Correo,         \PDO::PARAM_STR);
        $statement->bindParam(":Contrasena",     $Contrasena,     \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->CodigoUsuario =  $entry["CodigoUsuario"];
            $resultSet->NombreCompleto =  $entry["NombreCompleto"];
            $resultSet->PrimerApellido =  $entry["PrimerApellido"];
            $resultSet->SegundoApellido =  $entry["SegundoApellido"];
            $resultSet->CorreoElectronico =  $entry["CorreoElectronico"];
            $resultSet->Celular =  $entry["Celular"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        
        return $response;
    }
    public function ValidarUsuario($Celular)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_ValidarUsuario :Celular");
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Celular =  $entry["Celular"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function GenerarCodigo($Celular)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_ConfirmarUsuario :Celular");
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Usuario =  $entry["Usuario"];
            $resultSet->Codigo =  $entry["CodigoGenerado"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function ConsultarCodigo($Celular,$Codigo)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_ConsultarCodigoCelular :Celular,:Codigo");
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->bindParam(":Codigo",         $Codigo,         \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->CodigoValido =  $entry["CodigoValido"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
}