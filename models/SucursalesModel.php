<?php

namespace Maxilana\MaxilanaApp\Models;

use Phalcon\Mvc\Model as Modelo;
class DatosSucursal{
    public $codigo;
    public $nombre;
    public $direccion;
    public $telefono;
    public $whatsapp;
    public $maps;
    public $horarioconformato;
    public $ciudad;
    public $estado;
    public $nomciudad;
}
class DatosPlazas{

    public $Nombre;
    public $Codigo;

}
class SucursalesModel extends Modelo
{
    public function ObtenerCiudad()
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC NPR.dbo.sp_ObtenerCiudades 1");
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Codigo =  $entry["Codigo"];
            $resultSet->Nombre =  $entry["Nombre"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function ObtenerPlazas()
    {
        $PreResp = array();
        $ArrayJson = array();
        $response = array();

                    // Conectando, seleccionando la base de datos
                    $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
                    or die('No se pudo conectar: ' . mysql_error());
                    mysql_set_charset("UTF8",  $link);
                    mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
                    // Realizar una consulta MySQL
                    $query = "select id,nombre from ciudades";
                    $result = mysql_query($query) or die("Data not found."); 
                        while($r=mysql_fetch_assoc($result))
                        { 
                            $objeto = new DatosPlazas();
                            $objeto->Nombre = ($r["nombre"]);;
                            $objeto->Codigo = ($r["id"]);
                            $myArray[] = json_decode(json_encode($objeto), true);
                            $objeto = null;
                        }
                        mysql_close($link);
                        mysql_free_result($result);
                        $response = $myArray;
                        return $response;
    }
    public function ObtenerSucursales()
    {
        $PreResp = array();
        $ArrayJson = array();
        $response = array();

                    // Conectando, seleccionando la base de datos
                    $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
                    or die('No se pudo conectar: ' . mysql_error());
                    mysql_set_charset("UTF8",  $link);
                    mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
                    // Realizar una consulta MySQL
                    $query = "select s.id,s.nombre,s.direccion,s.telefono,s.whatsapp,s.HorarioConFormato,s.img_croquis,s.ciudad,s.estado,c.nombre as nomciudad
                    from sucursales s join ciudades c on s.ciudad = c.id where s.activo = 1";
                    $result = mysql_query($query) or die("Data not found."); 
                        while($r=mysql_fetch_assoc($result))
                        { 
                            $objeto = new DatosSucursal();
                            $objeto->codigo = ($r["id"]);
                            $objeto->nombre = ($r["nombre"]);;
                            $objeto->direccion = ($r["direccion"]);
                            $objeto->telefono = ($r["telefono"]);
                            $objeto->whatsapp = ($r["whatsapp"]);
                            $objeto->maps = ($r["img_croquis"]);
                            $objeto->ciudad = ($r["ciudad"]);
                            $objeto->horarioconformato = ($r["HorarioConFormato"]);
                            $objeto->estado = ($r["estado"]);
                            $objeto->nomciudad = ($r["nomciudad"]);
                            $myArray[] = json_decode(json_encode($objeto), true);
                            $objeto = null;
                        }
                        mysql_close($link);
                        mysql_free_result($result);
                        $response = $myArray;
                        return $response;
    }
    public function ObtenerMaps(){
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_MapSucursales");
        $statement->execute();
        while ($entry = 
        $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Codigo =  $entry["SUCCOD"];
            $resultSet->Nombre =  $entry["SUCNOM"];
            $resultSet->Direccion =  $entry["SUCDIR"];
            $resultSet->Telefono =  $entry["SUCTEL"];
            $resultSet->Latitud =  $entry["LATITUD"];
            $resultSet->Longitud =  $entry["LONGITUD"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
}