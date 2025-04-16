<?php


namespace Controllers;
//require __DIR__ . '/../classes/dompdf/autoload.inc.php';
//require __DIR__ . '/../classes/twilio-php-main/src/Twilio/autoload.php';
//require __DIR__ . '/../classes/aws/aws-autoloader.php';
use MVC\Router;
use Model\usuarios;
use Model\departments;
use Model\municipalities;
use Model\companies;
use Model\users;


class configuracioncontroller{

    public static function company(Router $router) {
        session_start();
        isadmin();
        date_default_timezone_set('America/Bogota');
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST' ){  ////// crear compañia ///////
            $dv = digitoVerificacionDIAN($_POST['numero_documento']);
            
            $user = new users([
                'name'=>$_POST['nombrerazonsocial'],
                'email'=>$_POST['email'],
                'password'=>password_hash($_POST['numero_documento'], PASSWORD_BCRYPT)
            ]);
            $user->api_token = hash('sha256', $_POST['numero_documento']);
            
            $company = new companies([
                //'user_id' => $user->id,
                "identification_number" => $_POST['numero_documento'],
                "dv" => $dv,
                'language_id' => 79,
                "tax_id" => $_POST['impuesto'],
                'type_environment_id' => 2,
                'type_operation_id' => 10,
                "type_document_identification_id" => $_POST['tipo_documento'],
                'country_id' => 46,
                'type_currency_id' => 35,
                "type_organization_id" => $_POST['tipoorganizacion'],
                "type_regime_id" => $_POST['regimen'],
                "type_liability_id" => $_POST['obligaciones'],
                "municipality_id" => $_POST['ciudad'],
                "merchant_registration" => "0000000-00",
                "address" => $_POST['direccion'],
                "phone" => ($_POST['telefono']),
            ]);
    
            $alertas = $user->validar_nuevo_user();
            $alertas = $company->validar_nueva_company();
            
            if(empty($alertas)){
                $newuser = $user->crear_guardar();
                if($newuser[0]){
                    $company->user_id = $newuser[1];
                    $newCompany = $company->crear_guardar();
                    if($newCompany[0]){
                        $alertas['exito'][] = "Empresa o negocio creado correctamente";
                    }else{
                        $userCreate = users::find('id', $company->user_id);
                        $deleteUser = $userCreate->eliminar_registro();
                        $alertas['error'][] = "Error en la creacion de la empresa o compañia, intenta nuevamente";
                    }
                }else{
                    $alertas['error'][] = "Error en la creacion del nombre o razon social del usuario";
                }
            }
        }

        $departments = departments::all();
        $companies = companies::all();
        foreach($companies as $index => $value){
            $value->objuser = users::find('id', $value->user_id);
        }
        $router->render('admin/configuracion/compañia', ['titulo'=>'config inicial', 'departments'=>$departments, 'companies'=>$companies, 'alertas'=>$alertas, 'user'=>$_SESSION]);
    }



    public static function software(Router $router) {
        $alertas = [];
        session_start();
        isadmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST' ){
            //eliminar el software anterior
            //creacion del nuevo software
            //
            
        }
        $usuario = usuarios::find('id', $_SESSION['id']);
        $router->render('admin/dashboard/perfil', ['titulo'=>'Perfil', 'usuario'=>$usuario, 'user'=>$_SESSION, 'alertas'=>$alertas]);
    }



    ///////////////////////////////////  Apis ////////////////////////////////////
    public static function citiesXdepartments(){  //api llamado desde ventas.js me trae todas las direcciones segun cliente elegido
        $id = $_GET['id'];
        $alertas = [];
        if(!is_numeric($id)){
            $alertas['error'][] = "Hubo un error el id del departamento no es valido";
            echo json_encode($alertas);
            return;
        }
        $municipios = municipalities::idregistros('department_id', $id);
        echo json_encode($municipios);
    }


    public static function eliminarCompany(){  //api llamado desde ventas.js me trae todas las direcciones segun cliente elegido
        $id = $_GET['id'];
        $alertas = [];
        if(!is_numeric($id)){
            $alertas['error'][] = "Hubo un error al eliminar la compañia";
            echo json_encode($alertas);
            return;
        }
        $company = companies::find('id', $id);
        if($company){
            $r = $company->eliminar_registro();
            if($r){
                $alertas['exito'][] = "Compañia eliminada correctamente";
            }else{
                $alertas['error'][] = "Error al eliminar la compañia de la base de datos";
            }
        }else{
            $alertas['error'][] = "Error al eliminar la compañia no fue encontrada";
        }
        echo json_encode($alertas);
    }

    
}

?>