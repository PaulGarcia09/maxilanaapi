<?php

namespace Maxilana\MaxilanaApp\Controllers;

use Maxilana\RAC\Controllers\RESTController;
use Maxilana\RAC\Exceptions\HTTPException;
use Maxilana\MaxilanaApp\Models as Modelos;

class RegistroController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\RegistroModel();
    }
    public function RegistroUsuario($ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena)
    {
        $response = null;
        try{
            $response = $this->modelo->RegistroUsuario($ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena);
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
    public function EditarUsuario($Usuario,$ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena)
    {
        $response = null;
        try{
            $response = $this->modelo->EditarUsuario($Usuario,$ApellidoP,$ApellidoM,$Nombre,$Celular,$Correo,$Contrasena);
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
    public function ValidarUsuario($Celular)
    {
        $response = null;
        try{
            $response = $this->modelo->ValidarUsuario($Celular);
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
    public function GenerarCodigo($Celular)
    {
        $response = null;
        try{
            $response = $this->modelo->GenerarCodigo($Celular);
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
    public function ConsultarCodigo($Celular,$Codigo)
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultarCodigo($Celular,$Codigo);
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
