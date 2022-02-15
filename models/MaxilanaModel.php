<?php

namespace Maxilana\MaxilanaApp\Models;
use Phalcon\Mvc\Model as Modelo;
class MaxilanaModel extends Modelo
{
    public function ObtenerCatalogo($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg){
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
    
    
        $whereQuery='';
        $OrderBy='';
        
        if($categoria <> '0'){
            $whereQuery = " WHERE r.tipo=".$categoria;
        }
        if($ciudad <> '0'){
            if($whereQuery <> ''){
               $whereQuery = $whereQuery." AND c.id=".$ciudad;
            }else{
                $whereQuery = " WHERE c.id=".$ciudad;
            }
        }
        if($sucursal <> '0'){
            if($whereQuery <> ''){
               $whereQuery = $whereQuery." AND s.id=".$sucursal;
            }else{
                $whereQuery = " WHERE s.id=".$sucursal;
            }
        }
    
        if($MStart <> '0'){
            if($MEnd <>'0'){
                if($whereQuery <> ''){
                    $whereQuery = " AND r.precioneto BETWEEN ".$MStart." AND ".$MEnd."";
                }else{
                    $whereQuery = " WHERE r.precioneto BETWEEN ".$MStart." AND ".$MEnd."";
                }
                
            }
        }
         if($orden == 'Desc'){
            $OrderBy=' ORDER BY r.nombre ASC';
         }
         if($orden == 'LowPrice'){
            $OrderBy=' ORDER BY r.precioneto ASC';
         }
         if($orden == 'UpPrice'){
            $OrderBy=' ORDER BY r.precioneto DESC';
         }
         if($pg == '1'){
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc  ,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.") as Total 
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.$OrderBy." LIMIT 0,20";
         }
         else{
            $items_ppage=20;
            $pagina=(!isset($pg)?1:$pg);
            $num_inicio=(($pagina-1)*$items_ppage);
            $num_fin=($items_ppage);
    
            $Limit =" LIMIT $num_inicio, $num_fin";
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc  ,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.") as Total 
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.$OrderBy.$Limit;
        }
    
         $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
        
         mysql_close($link);
    
         while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->nombre = utf8_encode($row["NombreArticulo"]);
            $objeto->codigo = $row["codigo"];
            $objeto->tipo = $row["tipo"];
            $objeto->precio = $row["precioneto"];
            $objeto->precionormal = $row["precio"];
            $objeto->telefono = $row["telefono"];
            $objeto->imagen =  (integer)$row["imagen"];
            $objeto->sucursal = $row["Sucursal"];
            $objeto->estado = $row["estado"];
            $objeto->ciudad = $row["Ciudad"];
            $objeto->whatsapp = $row["whatsapp"];
            $objeto->numsuc = $row["numSuc"];
            $objeto->TotalArticulos = $row['Total'];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
        }
        public function ObtenerVentaenlinea($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg){
            $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
            or die('No se pudo conectar: ' . mysql_error());
            mysql_set_charset("UTF8",  $link);
            mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');
        
        
            $whereQuery='';
            $OrderBy='';
            
            if($categoria <> '0'){
                $whereQuery = " WHERE r.tipo=".$categoria;
            }
            if($ciudad <> '0'){
                if($whereQuery <> ''){
                   $whereQuery = $whereQuery." AND c.id=".$ciudad;
                }else{
                    $whereQuery = " WHERE c.id=".$ciudad;
                }
            }
            if($sucursal <> '0'){
                if($whereQuery <> ''){
                   $whereQuery = $whereQuery." AND s.id=".$sucursal;
                }else{
                    $whereQuery = " WHERE s.id=".$sucursal;
                }
            }
        
            if($MStart <> '0'){
                if($MEnd <>'0'){
                    if($whereQuery <> ''){
                        $whereQuery = " AND r.precioneto BETWEEN ".$MStart." AND ".$MEnd."";
                    }else{
                        $whereQuery = " WHERE r.precioneto BETWEEN ".$MStart." AND ".$MEnd."";
                    }
                    
                }
            }
             if($orden == 'Desc'){
                $OrderBy=' ORDER BY r.nombre ASC';
             }
             if($orden == 'LowPrice'){
                $OrderBy=' ORDER BY r.precioneto ASC';
             }
             if($orden == 'UpPrice'){
                $OrderBy=' ORDER BY r.precioneto DESC';
             }
             if($pg == '1'){
                $query = " CONCAT(r.clasificacion,r.UPC) as codigo ,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc ,s.telefono, c.nombre as Ciudad, c.estado,
                (Select count(*) from articulosmercadolibre  r join sucursales s on s.id = r.codigosucursal  join ciudades c on c.id = s.ciudad ".$whereQuery.") as Total 
                from articulosmercadolibre  r join sucursales s on s.id = r.codigosucursal join ciudades c on c.id = s.ciudad ".$whereQuery.$OrderBy." LIMIT 0,20";
             }
             else{
                $items_ppage=20;
                $pagina=(!isset($pg)?1:$pg);
                $num_inicio=(($pagina-1)*$items_ppage);
                $num_fin=($items_ppage);
        
                $Limit =" LIMIT $num_inicio, $num_fin";
                $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc  ,s.telefono, c.nombre as Ciudad, c.estado,
                (Select count(*) from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.") as Total 
                from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereQuery.$OrderBy.$Limit;
            }
        
             $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
            
             mysql_close($link);
        
             while($row = mysql_fetch_array($result)){
                $objeto = new \stdClass();
                $objeto->nombre = utf8_encode($row["NombreArticulo"]);
                $objeto->codigo = $row["codigo"];
                $objeto->tipo = $row["tipo"];
                $objeto->precio = $row["precioneto"];
                $objeto->precionormal = $row["precio"];
                $objeto->telefono = $row["telefono"];
                $objeto->imagen =  (integer)$row["imagen"];
                $objeto->sucursal = $row["Sucursal"];
                $objeto->estado = $row["estado"];
                $objeto->ciudad = $row["Ciudad"];
                $objeto->whatsapp = $row["whatsapp"];
                $objeto->numsuc = $row["numSuc"];
                $objeto->TotalArticulos = $row['Total'];
                $myArray[] = json_decode(json_encode($objeto), true);
                $objeto = null;
            }
            $response = $myArray;
            mysql_free_result($result);
            return $response;
            }

/////////CATALOGOS END

    public function ObtenerRematesCiudad($tipo,$cd,$Pg){
        $whereTipo='';
        if($tipo <> "Todos"){
            $whereTipo = " where r.tipo=".$tipo;
         }
         $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
         or die('No se pudo conectar: ' . mysql_error());
         mysql_set_charset("UTF8",  $link);
         mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');

        if($Pg == '1'){
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc  ,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates ".$whereTipo." ) as Total 
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereTipo." and c.id=".$cd." LIMIT 0,20";
    
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    
            mysql_close($link);
        }
        else{

            $items_ppage=20;
            $pagina=(!isset($Pg)?1:$Pg);
            $num_inicio=(($pagina-1)*$items_ppage);
            $num_fin=($items_ppage);

            $Limit =" LIMIT $num_inicio, $num_fin";
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc ,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates ".$whereTipo." ) as Total 
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad ".$whereTipo." and c.id=".$cd.$Limit;
    
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    
            mysql_close($link);
        }
    



        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->nombre = utf8_encode($row["NombreArticulo"]);
            $objeto->codigo = $row["codigo"];
            $objeto->tipo = $row["tipo"];
            $objeto->precio = $row["precioneto"];
            $objeto->precionormal = $row["precio"];
            $objeto->telefono = $row["telefono"];
            $objeto->imagen =  (integer)$row["imagen"];
            $objeto->sucursal = $row["Sucursal"];
            $objeto->estado = $row["estado"];
            $objeto->ciudad = $row["Ciudad"];
            $objeto->whatsapp = $row["whatsapp"];
            $objeto->numsuc = $row["numSuc"];
            $objeto->TotalArticulos = $row['Total'];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ObtenerRematesPorTexto($texto,$Pg){

        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');

        if($Pg == '1'){
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates where nombre LIKE '%$texto%' OR  marca LIKE '%$texto%' OR observaciones LIKE '%$texto%') as Total
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad 
            where r.nombre LIKE '%$texto%' OR  r.marca LIKE '%$texto%' OR r.observaciones LIKE '%$texto%' LIMIT 0,20";
    
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    
            mysql_close($link);
        }
        else{
            $items_ppage=20;
            $pagina=(!isset($Pg)?1:$Pg);
            $num_inicio=(($pagina-1)*$items_ppage);
            $num_fin=($items_ppage);
            $Limit =" LIMIT $num_inicio, $num_fin";
            $query = "SELECT r.codigo,r.precio,r.precioneto,r.tipo,r.nombre as NombreArticulo,r.imagen,s.nombre as Sucursal ,s.whatsapp,s.id as numSuc ,s.telefono, c.nombre as Ciudad, c.estado,
            (Select count(*) from remates where (nombre LIKE '%$texto%' OR  marca LIKE '%$texto%' OR observaciones LIKE '%$texto%') as Total
            from remates r join sucursales s on s.id = r.sucursal join ciudades c on c.id = s.ciudad 
            where r.nombre LIKE '%$texto%' OR  r.marca LIKE '%$texto%' OR r.observaciones LIKE '%$texto%'".$Limit;
    
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    
            mysql_close($link);
        }
        if(count(mysql_fetch_array($result))>1){
            while($row = mysql_fetch_array($result)){
                $objeto = new \stdClass();
                $objeto->nombre = utf8_encode($row["NombreArticulo"]);
                $objeto->codigo = $row["codigo"];
                $objeto->tipo = $row["tipo"];
                $objeto->precio = $row["precioneto"];
                $objeto->precionormal = $row["precio"];
                $objeto->telefono = $row["telefono"];
                $objeto->imagen =  (integer)$row["imagen"];
                $objeto->sucursal = $row["Sucursal"];
                $objeto->numsuc = $row["numSuc"];
                $objeto->estado = $row["estado"];
                $objeto->ciudad = $row["Ciudad"];
                $objeto->whatsapp = $row["whatsapp"];
                $objeto->TotalArticulos = $row['Total'];
                $myArray[] = json_decode(json_encode($objeto), true);
                $objeto = null;
            }
            $response = $myArray;
        }
        else{
            $response = [];
        }
        mysql_free_result($result);
        return $response;
    }
    public function ConsultarCategorias(){

        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');



        $query = "select COUNT(r.tipo) as Cantidad ,t.nombre,t.id from remates as r inner join tipos as t on t.id = r.tipo GROUP by t.nombre";

            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);

        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->Cantidad = $row["Cantidad"];
            $objeto->nombre = $row["nombre"];
            $objeto->id = $row["id"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ConsultarCiudades($categoria){

        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');

        if($categoria == "0"){
            $query = "select COUNT(c.id) as Cantidad ,c.nombre,c.id from remates as r inner join sucursales as t on t.id = r.sucursal inner join ciudades c on c.id = t.ciudad GROUP by c.nombre";
        }else{
            $query = "select COUNT(c.id) as Cantidad ,c.nombre,c.id from remates as r inner join sucursales as t on t.id = r.sucursal inner join ciudades c on c.id = t.ciudad where r.tipo='$categoria' GROUP by c.nombre";
        }


            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);

        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->Cantidad = $row["Cantidad"];
            $objeto->nombre = $row["nombre"];
            $objeto->id = $row["id"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ConsultarSucursales($categoria,$ciudad){
        $whereTipo='';
        if($categoria <> "Todos"){
            $whereTipo = " where r.tipo=".$categoria;
         }
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');


            $query = "select COUNT(t.id) as Cantidad ,t.nombre,t.id from remates as r inner join sucursales as t on t.id = r.sucursal inner join ciudades c on c.id = t.ciudad ".$whereTipo." and c.id='$ciudad' GROUP by t.nombre";
        


            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);

        while($row = mysql_fetch_array($result)){
            $objeto = new \stdClass();
            $objeto->Cantidad = $row["Cantidad"];
            $objeto->nombre = $row["nombre"];
            $objeto->id = $row["id"];
            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function ObtenerArticulo(){
        $myArray=null;
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');


        $query = "SELECT a.codigo,r.nombre,r.marca,r.tipo,s.nombre as sucursal,r.precioneto,r.precio,a.contacto,s.telefono, c.nombre as Ciudad, c.estado 
        FROM articulodelmesapp a inner join remates r on a.codigo = r.codigo inner join sucursales s on s.id = r.sucursal inner join ciudades c on c.id = s.ciudad ";
        $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

        mysql_close($link);

    while($row = mysql_fetch_array($result)){
        $objeto = new \stdClass();
        $objeto->codigo = $row["codigo"];
        $objeto->nombre = $row["nombre"];
        $objeto->marca = $row["marca"];
        $objeto->tipo = $row["tipo"];
        $objeto->sucursal = $row["sucursal"];
        $objeto->precionormal = $row["precioneto"];
        $objeto->precio  = $row["precio"];
        $objeto->telefono  = $row["telefono"];
        $objeto->ciudad  = $row["Ciudad"];
        $objeto->estado  = $row["estado"];
        $objeto->contacto  = $row["contacto"];
        

            $myArray[] = json_decode(json_encode($objeto), true);
            $objeto = null;
        }
        $response = $myArray;
        mysql_free_result($result);
        return $response;
    }
    public function GrabarUpc($codigo){
        if($codigo == "vacio"){
            $codigo = "";
        }
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');


            $query = "UPDATE articulodelmesapp SET codigo='{$codigo}'";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);
        return $result;
    }
    public function ConsultarCodigoVentas($codigo){
        $myArray=null;
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');


            $query = "SELECT descripcion from articulosmercadolibre where CONCAT(clasificacion,upc)='{$codigo}'";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);
            while($row = mysql_fetch_array($result)){
                $objeto = new \stdClass();
                $objeto->descripcion = $row["descripcion"];
    
                $myArray[] = json_decode(json_encode($objeto), true);
                $objeto = null;
            }
            $response = $myArray;
            mysql_free_result($result);
            return $response;
    }
    public function ConsultarCategoriasAPP(){
        $myArray=null;
        $link = mysql_connect('consola.maxilana.com', 'maxilanabd', 'Cuitlahuac9607')
        or die('No se pudo conectar: ' . mysql_error());
        mysql_set_charset("UTF8",  $link);
        mysql_select_db('maxilanabd') or die('No se pudo seleccionar la base de datos');


            $query = "SELECT * FROM tipos WHERE visible=1";
            $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

            mysql_close($link);
            while($row = mysql_fetch_array($result)){
                $objeto = new \stdClass();
                $objeto->idcat = $row["id"];
                $objeto->imagen= $row["imagen"];
                $objeto->nombre= $row["nombre"];
    
                $myArray[] = json_decode(json_encode($objeto), true);
                $objeto = null;
            }
            $response = $myArray;
            mysql_free_result($result);
            return $response;
    }
    public function grabarpagoreamtes($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$upc,$correoenviado,$costoenvio,$precio,$esapp)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC ConsultasWEB.dbo.sp_Grabarespuestapw2remates :reference,:control_number,:cust_req_date,:auth_req_date,:auth_rsp_date,:cust_rsp_date,:payw_result,:auth_result,:payw_code,:auth_code,:text,:card_holder,:ussuing_bank,:card_brand,:card_type,:tarjeta,:correoelectronico,:monto,:codigosucursal,:upc,:correoenviado,:costoenvio,:precioetiqueta,:esapp");
        $statement->bindParam(":reference",        $reference,  \PDO::PARAM_INT);
        $statement->bindParam(":control_number",        $control_number,  \PDO::PARAM_STR);
        $statement->bindParam(":cust_req_date",        $cust_req_date,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_req_date",        $auth_req_date,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_rsp_date",        $auth_rsp_date,  \PDO::PARAM_STR);
        $statement->bindParam(":cust_rsp_date",        $cust_rsp_date,  \PDO::PARAM_STR);
        $statement->bindParam(":payw_result",        $payw_result,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_result",        $auth_result,  \PDO::PARAM_STR);
        $statement->bindParam(":payw_code",        $payw_code,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_code",        $auth_code,  \PDO::PARAM_STR);
        $statement->bindParam(":text",        $text,  \PDO::PARAM_STR);
        $statement->bindParam(":card_holder",        $card_holder,  \PDO::PARAM_STR);
        $statement->bindParam(":ussuing_bank",        $ussuing_bank,  \PDO::PARAM_STR);
        $statement->bindParam(":card_brand",        $card_brand,  \PDO::PARAM_STR);
        $statement->bindParam(":card_type",        $card_type,  \PDO::PARAM_STR);
        $statement->bindParam(":tarjeta",        $tarjeta,  \PDO::PARAM_STR);
        $statement->bindParam(":correoelectronico",        $correoelectronico,  \PDO::PARAM_STR);
        $statement->bindParam(":monto",        $monto,  \PDO::PARAM_STR);
        $statement->bindParam(":codigosucursal",        $codigosucursal,  \PDO::PARAM_INT);
        $statement->bindParam(":upc",        $upc,  \PDO::PARAM_INT);
        $statement->bindParam(":correoenviado",        $correoenviado,  \PDO::PARAM_INT);
        $statement->bindParam(":costoenvio",        $costoenvio,  \PDO::PARAM_STR);
        $statement->bindParam(":precioetiqueta",        $precio,  \PDO::PARAM_STR);
        $statement->bindParam(":esapp",        $esapp,  \PDO::PARAM_INT);
        
        $statement->execute();

        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->reference    =  $entry["reference"];
            $resultSet->Pedido    =  $entry["Pedido"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function grabarpagoboleta($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$boleta,$correoenviado,$fechaConsulta,$ctpago,$dias,$esapp)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC ConsultasWEB.dbo.sp_Grabarespuestapw2 :reference,:control_number,:cust_req_date,:auth_req_date,:auth_rsp_date,:cust_rsp_date,:payw_result,:auth_result,:payw_code,:auth_code,:text,:card_holder,:ussuing_bank,:card_brand,:card_type,:tarjeta,:correoelectronico,:monto,:codigosucursal,:boleta,:correoenviado,:ctpago,:fechaConsulta,:dias,:esapp");
        $statement->bindParam(":reference",        $reference,  \PDO::PARAM_INT);
        $statement->bindParam(":control_number",        $control_number,  \PDO::PARAM_STR);
        $statement->bindParam(":cust_req_date",        $cust_req_date,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_req_date",        $auth_req_date,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_rsp_date",        $auth_rsp_date,  \PDO::PARAM_STR);
        $statement->bindParam(":cust_rsp_date",        $cust_rsp_date,  \PDO::PARAM_STR);
        $statement->bindParam(":payw_result",        $payw_result,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_result",        $auth_result,  \PDO::PARAM_STR);
        $statement->bindParam(":payw_code",        $payw_code,  \PDO::PARAM_STR);
        $statement->bindParam(":auth_code",        $auth_code,  \PDO::PARAM_STR);
        $statement->bindParam(":text",        $text,  \PDO::PARAM_STR);
        $statement->bindParam(":card_holder",        $card_holder,  \PDO::PARAM_STR);
        $statement->bindParam(":ussuing_bank",        $ussuing_bank,  \PDO::PARAM_STR);
        $statement->bindParam(":card_brand",        $card_brand,  \PDO::PARAM_STR);
        $statement->bindParam(":card_type",        $card_type,  \PDO::PARAM_STR);
        $statement->bindParam(":tarjeta",        $tarjeta,  \PDO::PARAM_STR);
        $statement->bindParam(":correoelectronico",        $correoelectronico,  \PDO::PARAM_STR);
        $statement->bindParam(":monto",        $monto,  \PDO::PARAM_STR);
        $statement->bindParam(":codigosucursal",        $codigosucursal,  \PDO::PARAM_INT);
        $statement->bindParam(":boleta",        $boleta,  \PDO::PARAM_STR);
        $statement->bindParam(":correoenviado",        $correoenviado,  \PDO::PARAM_STR);
        $statement->bindParam(":fechaConsulta",        $fechaConsulta,  \PDO::PARAM_STR);
        $statement->bindParam(":ctpago",        $ctpago,  \PDO::PARAM_INT);
        $statement->bindParam(":dias",        $dias,  \PDO::PARAM_INT);
        $statement->bindParam(":esapp",        $esapp,  \PDO::PARAM_INT);
        $statement->execute();

        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->reference    =  $entry["Fecha"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    public function pagospendientes()
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC ConsultasWEB.dbo.Obtenerpagosactuales");
        $statement->execute();

        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->id    =  $entry["id"];
            $resultSet->reference    =  $entry["reference"];
            $resultSet->control_number    =  $entry["control_number"];
            $resultSet->cust_req_date    =  $entry["cust_req_date"];
            $resultSet->auth_req_date    =  $entry["auth_req_date"];
            $resultSet->auth_rsp_date    =  $entry["auth_rsp_date"];
            $resultSet->cust_rsp_date    =  $entry["cust_rsp_date"];
            $resultSet->payw_result    =  $entry["payw_result"];
            $resultSet->auth_result    =  $entry["auth_result"];
            $resultSet->payw_code    =  $entry["payw_code"];
            $resultSet->auth_code    =  $entry["auth_code"];
            $resultSet->text    =  $entry["text"];
            $resultSet->card_holder    =  $entry["card_holder"];
            $resultSet->issuing_bank    =  $entry["issuing_bank"];
            $resultSet->card_brand    =  $entry["card_brand"];
            $resultSet->card_type    =  $entry["card_type"];
            $resultSet->tarjeta    =  $entry["tarjeta"];
            $resultSet->correoelectronico    =  $entry["correoelectronico"];
            $resultSet->monto    =  $entry["monto"];
            $resultSet->codigosucursal    =  $entry["codigosucursal"];
            $resultSet->boleta    =  $entry["boleta"];
            $resultSet->correoelectronicoenviado    =  $entry["correoelectronicoenviado"];
            $resultSet->codigotipopago    =  $entry["codigotipopago"];
            $resultSet->fechaconsulta    =  $entry["fechaconsulta"];
            $resultSet->diaspagados    =  $entry["diaspagados"];
            $resultSet->pagoapp    =  $entry["pagoapp"];


            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }

    public function obtenerinfocliente($celular)
    {
        $di = \Phalcon\DI::getDefault();
        $response = array();
        $db = $di->get('conexionPrincipal');
        $statement = $db->prepare("EXEC AppEmpeño.dbo.sp_ObtenerInformacionCliente :Celular");

        $statement->bindParam(":Celular",        $celular,  \PDO::PARAM_STR);
        $statement->execute();

        while ($entry = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $resultSet = new \stdClass();
            $resultSet->id    =  $entry["CodigoUsuario"];
            $resultSet->Nombre    =  $entry["Nombre"];
            $resultSet->Celular    =  $entry["Celular"];
            $resultSet->CodigoCliente    =  $entry["CodigoCliente"];
            $resultSet->FechaRegistro    =  $entry["FechaRegistro"];
            $response[] = $resultSet;
            $resultSet = null;
        }
        return $response;
    }
    

}