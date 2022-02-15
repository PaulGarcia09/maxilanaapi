<?php

namespace Maxilana\MaxilanaApp\Controllers;

use Maxilana\RAC\Controllers\RESTController;
use Maxilana\RAC\Exceptions\HTTPException;
use Maxilana\MaxilanaApp\Models as Modelos;

class LoginController extends RESTController
{
    private $logger;
    private $modelo;

    public function onConstruct()
    {
        $this->logger = \Phalcon\DI::getDefault()->get('logger');
        $this->modelo = new Modelos\LoginModel();
    }
    #REGION LOGIN
    public function ConsultarUsuario($IdCel,$IdCorreo,$Password)
    {
        $response = null;
        try{
            $response = $this->modelo->ConsultaUsuario($IdCel,$IdCorreo,$Password);
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
   #END REGION LOGIN
    #REGION FORGOT PASSWORD
      //Funciona para validar datos del usuario y proceder a cambiar contraseña en caso de extravio
    public function ConfirmarDatosOC($Celular,$Correo)
    {
        $response = null;
        try{
            $response = $this->modelo->ConfirmarDatosOC($Celular,$Correo);
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
    public function validarCodigo($User,$Codigo)
    {
        $response = null;
        try{
            $response = $this->modelo->validarCodigo($User,$Codigo);
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
    public function ChangePassword($Usuario,$Password)
    {
        $response = null;
        try{
            $response = $this->modelo->ChangePassword($Usuario,$Password);
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
      
    #END REGION FORGOT PASSWORD
    public function ObtenerRemates()
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerRemates();
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
    public function ObtenerRematesCategos($tipo)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerRematesCategos($tipo);
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
    public function CancelarCodigo($Opcion,$Codigo)
    {
        $response = null;
        try{
            $response = $this->modelo->CancelarCodigo($Opcion,$Codigo);
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
    public function Obtenreferencia($referencia)
    {
        $response = null;
        try{
            $response = $this->modelo->Obtenreferencia($referencia);
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
    public function ObtenerRematesTexto($texto)
    {
        $response = null;
        try{
            $response = $this->modelo->ObtenerRematesTexto($texto);
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
