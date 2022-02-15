<?php

namespace Maxilana\RAC\Modules;

use PDO;
use Phalcon\Mvc\Micro\Collection;

class Module implements IModule
{
    public function __construct()
    {
    }

    public function registerLoader($loader)
    {
        $loader->registerNamespaces([
            'Maxilana\MaxilanaApp\Controllers' => __DIR__ . '/controllers/',
            'Maxilana\MaxilanaApp\Models' => __DIR__ . '/models/'
        ], true);
    }

    public function getCollections()
    {  

        $collectionLogin = new Collection();
        $collectionRegistro = new Collection();
        $collectionSucursales = new Collection();
        $collectionConfiguracion = new Collection();
        $collectionBoletas = new Collection();
        $collectionMaxilana = new Collection();
        ///VALIDA LA DIRECCION A DONDE SE CONECTARA(CONTROLADOR)///


        $collectionLogin->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\LoginController')
        ->setLazy(true);
        $collectionRegistro->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\RegistroController')
        ->setLazy(true);

        $collectionSucursales->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\SucursalesController')
        ->setLazy(true);

        $collectionConfiguracion->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\ConfigController')
        ->setLazy(true);

        $collectionBoletas->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\BoletasController')
        ->setLazy(true);

        $collectionMaxilana->setPrefix('/api')
        ->setHandler('\Maxilana\MaxilanaApp\Controllers\MaxilanaController')
        ->setLazy(true);

        //*REGION LOGIN *//
        $collectionLogin->get('/Usuarios/Cusuario/{CodigoUsuario}/Correo/{Correo}/Contrasena/{Contrasena}','ConsultarUsuario');
        $collectionLogin->get('/ForgotPassword/ConfirmarDatos/Celular/{Celular}/Correo/{Correo}','ConfirmarDatosOC');
        $collectionLogin->get('/ForgotPassword/ValidarCodigo/Usuario/{Usuario}/Codigo/{Codigo}','validarCodigo');
        $collectionLogin->get('/ForgotPassword/ChangePassword/Usuario/{CodigoUsuario}/Contrasena/{Contrasena}','ChangePassword');

        $collectionLogin->get('/CancelarCodigo/Opc/{Opcion}/Codigo/{Codigo}','CancelarCodigo');

        //*REGION REGISTRO *//
        $collectionRegistro->get('/Registro/ApellidoP/{ApellidoP}/ApellidoM/{ApellidoM}/Nombre/{Nombre}/Celular/{Celular}/Correo/{Correo}/Contrasena/{Contrasena}','RegistroUsuario');
        $collectionRegistro->get('/Registro/Editar/Usuario/{Usuario}/ApellidoP/{ApellidoP}/ApellidoM/{ApellidoM}/Nombre/{Nombre}/Celular/{Celular}/Correo/{Correo}/Contrasena/{Contrasena}','EditarUsuario');
        $collectionRegistro->get('/Registro/ValidaUsuario/{Celular}','ValidarUsuario');
        $collectionRegistro->get('/GenerarCodigo/Celular/{Celular}','GenerarCodigo');
        $collectionRegistro->get('/ConsultarCodigo/Celular/{Celular}/Codigo/{Codigo}','ConsultarCodigo');
        $collectionLogin->get('/ConsultarRemates','ObtenerRemates');
        $collectionLogin->get('/ConsultarRemates/{Categoria}','ObtenerRematesCategos');
        $collectionLogin->get('/ConsultarRemates/Busqueda/{Texto}','ObtenerRematesTexto');
        $collectionLogin->get('/informacion3dsecure/{reference}','Obtenreferencia');
        //*REGION SUCURSALES*//
        $collectionSucursales->get('/ConsultarCiudades','ObtenerCiudad');
        $collectionSucursales->get('/ConsultarSucursale','ObtenerSucursales');
        $collectionSucursales->get('/ConsultarPlazas','ObtenerPlazas');
        $collectionSucursales->get('/ConsultarMapas','ObtenerMaps');


        //*REGION BOLETAS*//
        $collectionBoletas->get('/ConsultarBoletas/Cliente/{Cliente}','ObtenerBoletas');
        $collectionBoletas->get('/AgregarBoleta/Cliente/{Cliente}/Boleta/{Boleta}/Letra/{Letra}/Prestamo/{Prstamo}','InsertarBoleta');
        $collectionBoletas->get('/EliminarBoleta/Cliente/{Cliente}/Boleta/{Boleta}','EliminarBoleta');
        $collectionBoletas->get('/FechaActual','ObtenerFechaActual');
        $collectionBoletas->get('/ConsultarPagosBoleta/Sucursal/{Sucursal}/Boleta/{Boleta}','consultarPagos');
        $collectionBoletas->get('/ConsultarClienteActivo/{Cliente}','ObtenerCodigoCliente');
        $collectionConfiguracion->get('/Contacto/Correo/{Correo}/{Asunto}/Problema/{Problema}','GrabarContacto');
        
        


        


        //*REGION MAXILANA.COM*//
        $collectionMaxilana->get('/ObtenerArticulo','ObtenerArticulo');
        $collectionMaxilana->get('/ConsultarCodigoVentas/{Codigo}','ConsultarCodigoVentas');
        $collectionMaxilana->get('/GrabarUpc/{upc}/upc','GrabarUpc');
        $collectionMaxilana->get('/obtenerremates/{tipo}/VD/{VD}/Page/{Pg}','ObtenerRemates');
        $collectionMaxilana->get('/ObtenerCatalogo/{categoria}/Cd/{ciudad}/Suc/{suc}/MStart/{MStart}/MEnd/{MEnd}/Orden/{orden}/pg/{pg}','ObtenerCatalogo');
        
        $collectionMaxilana->get('/obtenerremates/{tipo}/Ciudad/{Ciudad}/Page/{Pg}','ObtenerRematesCiudad');
        $collectionMaxilana->get('/obtenerremates/texto/{texto}/Page/{Pg}','ObtenerRematesPorTexto');
        $collectionMaxilana->get('/ConsultarCategorias','ConsultarCategorias');
        $collectionMaxilana->get('/ConsultarCiudades/{Todos}','ConsultarCiudades');
        $collectionMaxilana->get('/ConsultarSucursales/{Todos}/Ciudad/{Todas}','ConsultarSucursales');


        $collectionMaxilana->get('/grabarpagoreamtes/reference/{reference}/control_number/{control_number}/cust_req_date/{cust_req_date}/auth_req_date/{auth_req_date}/auth_rsp_date/{auth_rsp_date}/cust_rsp_date/{cust_rsp_date}/payw_result/{payw_result}/auth_result/{auth_result}/payw_code/{payw_code}/auth_code/{auth_code}/text/{text}/card_holder/{card_holder}/ussuing_bank/{ussuing_bank}/card_brand/{card_brand}/card_type/{card_type}/tarjeta/{tarjeta}/correoelectronico/{correoelectronico}/monto/{monto}/codigosucursal/{codigosucursal}/upc/{upc}/correoenviado/{correoenviado}/costoenvio/{costoenvio}/precio/{precio}/esapp/{esapp}','grabarpagoreamtes');
        $collectionMaxilana->get('/grabarpagoboleta/reference/{reference}/control_number/{control_number}/cust_req_date/{cust_req_date}/auth_req_date/{auth_req_date}/auth_rsp_date/{auth_rsp_date}/cust_rsp_date/{cust_rsp_date}/payw_result/{payw_result}/auth_result/{auth_result}/payw_code/{payw_code}/auth_code/{auth_code}/text/{text}/card_holder/{card_holder}/ussuing_bank/{ussuing_bank}/card_brand/{card_brand}/card_type/{card_type}/tarjeta/{tarjeta}/correoelectronico/{correoelectronico}/monto/{monto}/codigosucursal/{codigosucursal}/boleta/{boleta}/correoenviado/{correoenviado}/fechaConsulta/{fechaConsulta}/ctpago/{ctpago}/dias/{dias}/esapp/{esapp}','grabarpagoboleta');
        $collectionMaxilana->get('/infocliente/celular/{reference}','obtenerinfocliente');


        $collectionMaxilana->get('/ConsultarCategoriasAPP','ConsultarCategoriasAPP');
        $collectionMaxilana->get('/pagospendientes','pagospendientes');
        

        return [
           $collectionLogin,$collectionRegistro,$collectionSucursales,$collectionConfiguracion,$collectionBoletas,$collectionMaxilana
        ];
    }   

    public function registerServices()
    {
        $di = \Phalcon\DI::getDefault();

        $di->set('conexionPrincipal', function() use ($di) {
            $config = $di->get('config');
            $host = $config->conexionPrincipal->host;
            $dbname = $config->conexionPrincipal->dbname;
            $user = $config->conexionPrincipal->username;
            $password = $config->conexionPrincipal->password;
            return new \PDO("sqlsrv:Server=$host;Database=$dbname", $user, $password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
            // return new \PDO("dblib:host=$host;dbname=$dbname;charset=utf8", $user, $password, array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        });

        $di->set('logger', function () {
            return new \Katzgrau\KLogger\Logger('logs');
        });
    }
}
