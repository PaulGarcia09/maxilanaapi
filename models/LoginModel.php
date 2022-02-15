<?php

namespace Maxilana\MaxilanaApp\Models;
use Phalcon\Mvc\Model as Modelo;
class DatosClass{
    public $nombre;
    public $precio;
    public $telefono;
    public $imagen;
    public $codigo;
    public $sucursal;
    public $estado;
    public $ciudad;
}
class DatosSucursal{
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

    public $nombre;
    public $codigo;

}
class LoginModel extends Modelo
{
    #REGION LOGIN
    public function ConsultaUsuario($IdCel,$IdCorreo,$Password)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_LoginAPP 1,:IdCel,:IdCorreo,:Password");
        $statement->bindParam(":IdCel",            $IdCel,            \PDO::PARAM_INT);
        $statement->bindParam(":IdCorreo",         $IdCorreo,         \PDO::PARAM_STR);
        $statement->bindParam(":Password",         $Password,         \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
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
    #END REGION LOGIN
    #REGION FORGOT PASSWORD
    //Funciona para validar datos del usuario y proceder a cambiar contraseña en caso de extravio
    public function ConfirmarDatosOC($Celular,$Correo)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_LoginAPP 2,:Celular,:Correo,'Prueba'");
        $statement->bindParam(":Celular",        $Celular,        \PDO::PARAM_INT);
        $statement->bindParam(":Correo",         $Correo,         \PDO::PARAM_STR);
        $statement->execute();
        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->Usuario =  $entry["Usuario"];
            $resultSet->CodigoGenerado =  $entry["CodigoGenerado"];
            $resultSet->Celular = $entry["Celular"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function validarCodigo($User,$Codigo)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_LoginAPP 3,:User,'Vacio',:Codigo");
        $statement->bindParam(":User",         $User,         \PDO::PARAM_INT);
        $statement->bindParam(":Codigo",       $Codigo,       \PDO::PARAM_STR);
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
    public function ChangePassword($Usuario,$Password)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_LoginAPP 4,:Usuario,'Vacio',:Password");
        $statement->bindParam(":Usuario",            $Usuario,            \PDO::PARAM_INT);
        $statement->bindParam(":Password",         $Password,         \PDO::PARAM_STR);
        $statement->execute();
        return $response;
    }

    public function CancelarCodigo($Opcion,$Codigo)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_CancelarCodigo :Opcion,:Codigo");
        $statement->bindParam(":Opcion",         $Opcion,         \PDO::PARAM_INT);
        $statement->bindParam(":Codigo",         $Codigo,         \PDO::PARAM_STR);
        $statement->execute();
        return $response;
    }
    public function ObtenerRemates2()
    {
        $PreResp = array();
        $ArrayJson = array();
        $response = array();

                    // Conectando, seleccionando la base de datos
                    $link = mysql_connect('consola.consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
                    or die('No se pudo conectar: ' . mysql_error());
                    mysql_set_charset("UTF8",  $link);
                    mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
                    // Realizar una consulta MySQL
                    $query = 'select r.codigo,r.precioneto,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal,s.telefono, c.nombre as Ciudad, c.estado 
                    from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad';
                    $result = mysql_query($query) or die("Data not found."); 
                    mysql_close($link);
                    
                        while($r=mysql_fetch_assoc($result))
                        { 
        
                            $objeto = new DatosClass();
                            $objeto->nombre =($r["NombreArticulo"]);
                            $objeto->codigo = (string)$r["codigo"];
                            $objeto->precio = (string)$r["precioneto"];
                            $objeto->telefono =(string)$r["telefono"];
                            $objeto->imagen = (integer)$r["imagen"];
                            $objeto->sucursal = ($r["Sucursal"]);
                            $objeto->estado = ($r["estado"]);
                            $objeto->ciudad = ($r["Ciudad"]);
                            $myArray[] = json_decode(json_encode($objeto), true);
                            $objeto = null;
                            
                        }
                        $response = $myArray;
                        mysql_free_result($result);
                        return $response;
            
    }
    public function ObtenerRemates(){

        $link = mysql_connect('consola.consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
        $query = "SELECT CONCAT(r.clasificacion,r.UPC) as codigo,r.precio,r.precioneto,CONCAT(r.nombre,' ',r.marca,' ',r.modelo) as NombreArticulo,s.nombre as Sucursal,s.numero as scodigosucursal ,s.whatsapp ,s.telefono, c.nombre as Ciudad , c.estado, rt.imagen, r.descripcion from articulosmercadolibre r join sucursales s on s.id = r.codigosucursal join ciudades c on c.id = s.ciudad 
        inner join remates rt on rt.codigo=CONCAT(r.clasificacion,r.UPC)";

        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

        mysql_close($link);
        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->nombre = utf8_decode($row["NombreArticulo"]);
            $objeto->codigo = $row["codigo"];
            $objeto->precio = $row["precioneto"];
            $objeto->precionormal = $row["precio"];
            $objeto->telefono = $row["telefono"];
            $objeto->imagen =  (integer)$row["imagen"];
            $objeto->sucursal = $row["Sucursal"];
            $objeto->codigosucursal = $row["scodigosucursal"];
            $objeto->descripcion = $row["descripcion"]; 
            $objeto->estado = $row["estado"];
            $objeto->ciudad = $row["Ciudad"];
            $objeto->whatsapp = $row["whatsapp"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ObtenerRematesCategos($Categoria){

        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
        $query = "SELECT CONCAT(r.clasificacion,r.UPC) as codigo,r.precio,r.precioneto,CONCAT(r.nombre,' ',r.marca,' ',r.modelo) as NombreArticulo,s.nombre as Sucursal,s.numero as scodigosucursal ,s.whatsapp ,s.telefono, c.nombre as Ciudad , c.estado, rt.imagen, r.descripcion from articulosmercadolibre r join sucursales s on s.id = r.codigosucursal join ciudades c on c.id = s.ciudad 
        inner join remates rt on rt.codigo=CONCAT(r.clasificacion,r.UPC) inner join tipos t on t.id=r.tipo  where t.id='{$Categoria}'";

        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

        mysql_close($link);
        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->nombre = utf8_decode($row["NombreArticulo"]);
            $objeto->codigo = $row["codigo"];
            $objeto->precio = $row["precioneto"];
            $objeto->precionormal = $row["precio"];
            $objeto->telefono = $row["telefono"];
            $objeto->descripcion = $row["descripcion"];
            $objeto->imagen =  (integer)$row["imagen"];
            $objeto->sucursal = $row["Sucursal"];
            $objeto->codigosucursal = $row["scodigosucursal"];
            $objeto->estado = $row["estado"];
            $objeto->ciudad = $row["Ciudad"];
            $objeto->whatsapp = $row["whatsapp"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function Obtenreferencia($referencia){
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
        $query = "SELECT * FROM informacion3dsecure where reference='{$referencia}'";

        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

        mysql_close($link);
        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->reference = $row["reference"];
            $objeto->eci = $row["eci"];
            $objeto->xid = $row["xid"];
            $objeto->cavv = $row["cavv"];
            $objeto->status	 =  $row["status"];
            $objeto->cardtype = $row["cardtype"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ObtenerRematesTexto($texto){

        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
        $query = "SELECT CONCAT(r.clasificacion,r.UPC) as codigo,r.precio,r.precioneto,r.nombre as NombreArticulo,s.nombre as Sucursal,s.numero as scodigosucursal ,s.whatsapp ,s.telefono, c.nombre as Ciudad , c.estado, rt.imagen, r.descripcion from articulosmercadolibre r join sucursales s on s.id = r.codigosucursal join ciudades c on c.id = s.ciudad 
        inner join remates rt on rt.codigo=CONCAT(r.clasificacion,r.UPC) inner join tipos t on t.id=r.tipo  where r.nombre like '%".$texto."%'";

        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

        mysql_close($link);
        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->nombre = utf8_encode($row["NombreArticulo"]);
            $objeto->codigo = $row["codigo"];
            $objeto->precio = $row["precioneto"];
            $objeto->precionormal = $row["precio"];
            $objeto->telefono = $row["telefono"];
            $objeto->descripcion = $row["descripcion"];
            $objeto->imagen =  (integer)$row["imagen"];
            $objeto->sucursal = $row["Sucursal"];
            $objeto->codigosucursal = $row["scodigosucursal"];
            $objeto->estado = $row["estado"];
            $objeto->ciudad = $row["Ciudad"];
            $objeto->whatsapp = $row["whatsapp"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
}