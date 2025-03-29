<?php 

require_once __DIR__ . '/../includes/app.php'; //apunta al directorio raiz y luego a app.php, el archivo app contiene: las variables de entorno para el deploy,
                    //la clase ActiveRecord, el autoload de composer = localizador de clases, archivo de funciones debuguear y sanitizar html
                    //archivo de conexion de bd mysql con variables de entorno y me establece la conexion mediante: ActiveRecord::setDB($db);

//me importa clases del controlador

use Controllers\logincontrolador; //clase para logueo, registro de usuario, recuperacion, deslogueo etc..
use Controllers\dashboardcontrolador;
use Controllers\contabilidadcontrolador;
use Controllers\almacencontrolador;
use Controllers\cajacontrolador;
use Controllers\ventascontrolador;
use Controllers\reportescontrolador;
use Controllers\clientescontrolador;
use Controllers\direccionescontrolador;
use Controllers\configcontrolador;
use Controllers\paginacontrolador;

// me importa la clase router
use MVC\Router;



$router = new Router();



// Login
$router->get('/login', [logincontrolador::class, 'login']);
$router->post('/login', [logincontrolador::class, 'login']);
$router->post('/logout', [logincontrolador::class, 'logout']);

// Crear Cuenta
$router->get('/registro', [logincontrolador::class, 'registro']);
$router->post('/registro', [logincontrolador::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [logincontrolador::class, 'olvide']);
$router->post('/olvide', [logincontrolador::class, 'olvide']);

// Colocar el nuevo password
$router->get('/recuperarpass', [logincontrolador::class, 'recuperarpass']);
$router->post('/recuperarpass', [logincontrolador::class, 'recuperarpass']);

// Confirmación de Cuenta
$router->get('/mensaje', [logincontrolador::class, 'mensaje']);
$router->get('/confirmar-cuenta', [logincontrolador::class, 'confirmar_cuenta']);

//area publica
//$router->get('/', [paginacontrolador::class, 'index']);
$router->get('/', [logincontrolador::class, 'login']);
$router->get('/printfacturacarta', [cajacontrolador::class, 'printfacturacarta']); //llamado desde ordenresumen 


/////area dashboard/////
$router->get('/admin/dashboard', [dashboardcontrolador::class, 'index']);


$router->comprobarRutas();
