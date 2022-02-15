<?php

namespace Maxilana\MaxilanaApp\Controllers;

use Maxilana\RAC\Controllers\RESTController;
use Maxilana\RAC\Exceptions\HTTPException;
use Maxilana\MaxilanaApp\Models as Modelos;

class SucursalesController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\SucursalesModel();
    }
    public function ObtenerCiudad()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerCiudad();
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
    public function ObtenerPlazas()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerPlazas();
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
    public function ObtenerSucursales()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerSucursales();
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
    public function ObtenerMaps()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerMaps();
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
