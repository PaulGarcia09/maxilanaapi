<?php

namespace Maxilana\MaxilanaApp\Models;

use Phalcon\Mvc\Model as Modelo;

class BoletasModel extends Modelo
{
    public function ObtenerBoletas($Cliente)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_ObtenerSaldoBoletas :Cliente");
        $statement->bindParam(":Cliente",      $Cliente,      \PDO::PARAM_INT);
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Boleta =  $entry["BoletaActual"];
            $resultSet->FecVen =  $entry["FechaVencimiento"];
            $resultSet->Prestamo =  $entry["Prestamo"];
            $resultSet->Refrendo =  $entry["Refrendo"];
            $resultSet->Sucursal =  $entry["NombreSucursal"];
            $resultSet->Codigosucursal =  $entry["CodigoSucursal"];
            $resultSet->Estatus =  $entry["Situacion"];
            $resultSet->Nombre =  $entry["Nombre"];
            $resultSet->ApellidoP =  $entry["PrimerApellido"];
            $resultSet->ApellidoM =  $entry["SegundoApellido"];
            $resultSet->FLR =  $entry["FecEmpeno"]; // se agrega por correción de producción
            $resultSet->Banco =  "1.03";
            $resultSet->fechaConsulta= $entry["FechaConsulta"];
            $resultSet->Prefijo= $entry["Prefijo"];
            $resultSet->InteresdiarioActivo= $entry["InteresdiarioActivo"];
            $resultSet->InteresDiarioVencido= $entry["InteresDiarioVencido"];
            $resultSet->DiasPagoMinimo= $entry["DiasPagoMinimo"];
            $resultSet->ImportePagoMinimo= $entry["ImportePagoMinimo"];
            $resultSet->DiasVencidosPendientes= $entry["DiasVencidosPendientes"];
            $resultSet->SaldoAFavor= $entry["SaldoAFavor"];
            $resultSet->BoletaBloqueada= $entry["BoletaBloqueada"];
            $resultSet->Mensaje= $entry["Mensaje"];
            $resultSet->PagoEnProceso= $entry["PagoEnProceso"];
            $resultSet->SaldoPorAplicar= $entry["SaldoAbonosPorAplicar"];
            $resultSet->PermitirPago= $entry["PermitirPago"];
            $resultSet->comision= 1.03;
            $resultSet->TipoEmpeno= $entry['Familia'];
            $resultSet->FecEmpeno =  $entry["FecEmpeno"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function ObtenerCodigoCliente($Cliente)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_validarClienteActivo :Cliente");
        $statement->bindParam(":Cliente",      $Cliente,      \PDO::PARAM_INT);
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->CodigoCliente =  $entry["CodigoCliente"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function InsertarBoleta($Cliente,$Boleta,$Letra,$Prestamo)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_InsertarBoleta :Cliente,:Boleta,:Letra,:Prestamo");
        $statement->bindParam(":Cliente",    $Cliente,      \PDO::PARAM_INT);
        $statement->bindParam(":Boleta",     $Boleta,      \PDO::PARAM_STR);
        $statement->bindParam(":Letra",      $Letra,      \PDO::PARAM_STR);
        $statement->bindParam(":Prestamo",   $Prestamo,      \PDO::PARAM_STR);

        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Boleta =  $entry["BoletaActual"];
            $resultSet->FecVen =  $entry["FechaVencimiento"];
            $resultSet->Prestamo =  $entry["Prestamo"];
            $resultSet->Refrendo =  $entry["Refrendo"];
            $resultSet->Sucursal =  $entry["NombreSucursal"];
            $resultSet->Estatus =  $entry["Situacion"];
            $resultSet->Nombre =  $entry["Nombre"];
            $resultSet->ApellidoP =  $entry["PrimerApellido"];
            $resultSet->ApellidoM =  $entry["SegundoApellido"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function EliminarBoleta($Cliente,$Boleta)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_EliminarBoleta :Cliente,:Boleta");
        $statement->bindParam(":Cliente",      $Cliente,      \PDO::PARAM_INT);
        $statement->bindParam(":Boleta",      $Boleta,      \PDO::PARAM_STR);
        $statement->execute();
        return $response;
    }
    public function ObtenerFechaActual()
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("SELECT FORMAT(GETDATE(),'yyyy/MM/dd') as FechaActual");
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->FechaActual =  $entry["FechaActual"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function consultarPagos($sucursal,$boleta)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_BoletasConsultarPagos :Sucursal,:Boleta");
        $statement->bindParam(":Sucursal",      $sucursal,      \PDO::PARAM_INT);
        $statement->bindParam(":Boleta",      $boleta,      \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->BoletaOrigen =  $entry["BoletaOrigen"];
            $resultSet->BoletaActual =  $entry["BoletaActual"];
            $resultSet->FechaRecibo =  $entry["FechaRecibo"];
            $resultSet->DescripcionOperacion =  $entry["DescripcionOperacion"];
            $resultSet->Total =  $entry["Total"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    

}