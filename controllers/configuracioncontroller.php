<?php

namespace Controllers;
use MVC\Router;
use Model\usuarios;
use Model\departments;
use Model\municipalities;
use Model\companies;
use Model\users;
use Model\software;
use Model\certificates;
use Model\resolutions;


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
            self::software($router, $newCompany[1], $_POST);
            self::certificate($router, $newCompany[1], $_POST, $_FILES);
            //Creando resolucion pruebas
            $data = [
                "type_document_id" => 1,
                "prefix" => "SETP",
                "resolution" => "18760000001",
                "resolution_date" => "2019-01-19",
                "technical_key" => "fc8eac422eba16e22ffd8c6f94b3f40a6e38162c",
                "from" => 990000000,
                "to" => 995000000,
                "generated_to_date" => 0,
                "date_from" => "2019-01-19",
                "date_to" => "2030-01-19"
            ];
            self::resolution($router, $newCompany[1], $data);
        }

        $departments = departments::all();
        $companies = companies::all();
        foreach($companies as $index => $value){
            $value->objuser = users::find('id', $value->user_id);
        }
        $router->render('admin/configuracion/compañia', ['titulo'=>'config inicial', 'departments'=>$departments, 'companies'=>$companies, 'alertas'=>$alertas, 'user'=>$_SESSION]);
    }



    ///////////////////////////////////  Apis ////////////////////////////////////
    public static function software(Router $router, $idcompany, $arrayPOS):void {
        $alertas = [];
        //session_start();
        isadmin();
        //verificar y eliminar el software anterior
        $software = software::find('company_id', $idcompany);
        if($software)$r = $software->eliminar_registro();
        //creacion del nuevo software
        $newSoftware = new software([
            'company_id'=>$idcompany,
            'identifier'=>$arrayPOS['idsoftware'],
            'pin'=>$arrayPOS['pinsoftware'],
            'url'=>$arrayPOS['url']?? 'https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc'
        ]);
        $r1 = $newSoftware->crear_guardar();
    }


    public static function certificate(Router $router, $idcompany, $pos, $file) {
        $alertas = [];
        isadmin();
        
        // Validar archivo subido
        if (!isset($file['certificadoDigital']) || $file['certificadoDigital']['error'] !== UPLOAD_ERR_OK) {
            $alertas['error'][] = "Archivo requerido o invalido";
            return $alertas;
        }
        // Validar password del certificado
        $password = $pos['password'] ?? null;
        if (!$password) {
            $alertas['error'][] = "Password requerido";
            return $alertas;
        }

        // Obtener archivo .p12 subido y validar
        $tempP12 = $file['certificadoDigital']['tmp_name'];
        $certificateBinary = file_get_contents($tempP12);

        //Lectura del certificado .p12
        if (!openssl_pkcs12_read($certificateBinary, $certificate, $password)) {
            $error = openssl_error_string() ?: 'El certificado no pudo ser leído.';
            $alertas['error'][] = $error;
            return $alertas;
        }

        // Obtener la empresa del usuario
        $company = companies::find('id', $idcompany);
        // crear el nombre del certificado con el nit y dv para guardar en disco y DB
        $nombreFileP12 = "{$company->identification_number}{$company->dv}.p12";
        // Eliminar registro de certificado en DB anterior si existe
        $certificatedb = certificates::find('company_id', $idcompany);
        if($certificatedb)$r = $certificatedb->eliminar_registro();
        // Guardar el archivo .p12 en disco
        $storagePath = __DIR__ . "/certificates/$nombreFileP12";
        move_uploaded_file($tempP12, $storagePath);
        //file_put_contents($storagePath, $certificateBinary);  //se usa cuando se tiene el contenido del archivo en memoria, Una cadena con contenido (ej: base64)
        
        // Guardar la información del certificado en la base de datos
        $newCertificate = new certificates([
            'company_id'=>$idcompany,
            'name'=>$nombreFileP12,
            'password'=>$pos['password'],
            //'expiration_date' => $expiration_date,
        ]);
        $r1 = $newCertificate->crear_guardar();
    }


    public static function resolution(Router $router, $idcompany, $data):void {
        $alertas = [];
        isadmin();
        //verificar si existe una resolucion conel mismo tipo de factura, num resolucion y prefijo que pertenezca a la misma compañia
        $resol = resolutions::uniquewhereArray(['company_id'=>$idcompany, 'type_document_id'=>$data['tipofactura'], 'resolution'=>$data['resolution'], 'prefix'=>$data['prefix']]);
        /// si ya existe esa resolucion actualizar, de lo contrario crear nueva
        if($resol){
            $resol->compara_objetobd_post($data);
        }else{
            $newResol = new resolutions([
                'company_id'=>$idcompany,
                'type_document_id' => $data['tipofactura'],
                'prefix'=>$data['prefix'],
                'resolution'=>$data['resolution'],
                'resolution_date' => $data['resolution_date'],
                'technical_key' => $data['technical_key'],
                'from' => $data['from'],
                'to' => $data['to'],
                'date_from' => $data['date_from'],
                'date_to' => $data['date_to'],
            ]);
            $r = $newResol->crear_guardar();
        }
    }


    public static function environment(Router $router, $idcompany, $data):void {
        $alertas = [];
        isadmin();
        $company = companies::find('id', $idcompany);
        $company->type_environment_id = $data['type_environment_id'];
        //$company->payroll_type_environment_id = $data['payroll_type_environment_id'];
        //$company->eqdocs_type_environment_id = $data['eqdocs_type_environment_id'];
        $r = $company->actualizar();
        $software = software::find('company_id', $idcompany);
        if($data['type_environment_id'] == 1){
            $software->url = "https://vpfe.dian.gov.co/WcfDianCustomerServices.svc";
        }else{
            $software->url = "https://vpfe-hab.dian.gov.co/WcfDianCustomerServices.svc";
        }
        $r1 = $software->actualizar();
    }

    
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