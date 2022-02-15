<?php

namespace Maxilana\MaxilanaApp\Controllers;

use Maxilana\RAC\Controllers\RESTController;
use Maxilana\RAC\Exceptions\HTTPException;
use Maxilana\MaxilanaApp\Models as Modelos;

class MaxilanaController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\MaxilanaModel();
    }
    public function ObtenerCatalogo($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerCatalogo($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ObtenerVentaenlinea($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerVentaenlinea($categoria,$ciudad,$sucursal,$MStart,$MEnd,$orden,$pg);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ObtenerRematesCiudad($Tipo,$cd,$Pg)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerRematesCiudad($Tipo,$cd,$Pg);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ObtenerRematesPorTexto($texto,$Pg)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerRematesPorTexto($texto,$Pg);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ConsultarCategorias()
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarCategorias();
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ConsultarCiudades($categoria)
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarCiudades($categoria);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ConsultarSucursales($categoria,$ciudad)
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarSucursales($categoria,$ciudad);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ObtenerArticulo()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerArticulo();
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function GrabarUpc($codigo)
    {
        $response = null;
        try{
            $response = $this->modelo->GrabarUpc($codigo);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ConsultarCodigoVentas($codigo)
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarCodigoVentas($codigo);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function ConsultarCategoriasAPP()
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarCategoriasAPP();
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function grabarpagoreamtes($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$upc,$correoenviado,$costoenvio,$precio,$esapp){
        $response = null;
        try{
            $response = $this->modelo->grabarpagoreamtes($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$upc,$correoenviado,$costoenvio,$precio,$esapp);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function grabarpagoboleta($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$boleta,$correoenviado,$fechaConsulta,$ctpago,$dias,$esapp){
        $response = null;
        try{
            $response = $this->modelo->grabarpagoboleta($reference,$control_number,$cust_req_date,$auth_req_date,$auth_rsp_date,$cust_rsp_date,$payw_result,$auth_result,$payw_code,$auth_code,$text,$card_holder,$ussuing_bank,$card_brand,$card_type,$tarjeta,$correoelectronico,$monto,$codigosucursal,$boleta,$correoenviado,$fechaConsulta,$ctpago,$dias,$esapp);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function pagospendientes(){
        $response = null;
        try{
            $response = $this->modelo->pagospendientes();
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
    public function obtenerinfocliente($celular){
        $response = null;
        try{
            $response = $this->modelo->obtenerinfocliente($celular);
        }catch (\Exception $ex) {
            $mensaje = $ex->getMessage();
            $this->logger->error('['. __METHOD__ ."] Se lanzó la excepción > $mensaje");
            throw new HTTPException(
                'No fue posible completar su solicitud, intente de nuevo por favor.',
                500, [
                    'dev' => $mensaje,
                    'internalCode' => 'SIE1000',
                    'more' => 'Verificar conexión con la base de datos.'
                ]
            );
        }
        return $this->respond(['response' => $response]);
    }
}
