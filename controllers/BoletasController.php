<?php

namespace Maxilana\MaxilanaApp\Controllers;

use Maxilana\RAC\Controllers\RESTController;
use Maxilana\RAC\Exceptions\HTTPException;
use Maxilana\MaxilanaApp\Models as Modelos;

class BoletasController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\BoletasModel();
    }
    public function ObtenerBoletas($Cliente)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerBoletas($Cliente);
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
    public function InsertarBoleta($Cliente,$Boleta,$Letra,$Prstamo)
    {
        $response = null;
        try{
            $response = $this->modelo->InsertarBoleta($Cliente,$Boleta,$Letra,$Prstamo);
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
    public function EliminarBoleta($Cliente,$Boleta)
    {
        $response = null;
        try{
            $response = $this->modelo->EliminarBoleta($Cliente,$Boleta);
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

    public function ObtenerFechaActual()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerFechaActual();
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
    public function consultarPagos($Sucursal,$Boleta){
        $response = null;
        try{
            $response = $this->modelo->consultarPagos($Sucursal,$Boleta);
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
    public function ObtenerCodigoCliente($cliente){
        $response = null;
        try{
            $response = $this->modelo->ObtenerCodigoCliente($cliente);
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
