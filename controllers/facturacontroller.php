<?php

namespace Controllers;

use Classes\Email;
use Model\AllowanceCharge;
use Model\usuarios;
use Model\users;
use Model\companies;
use Model\resolutions;
use Model\payment_forms;
use Model\payment_methods;
use Model\type_documents;
use MVC\Router;  //namespace\clase
 
class facturacontroller{

  private static $paymentFormDefault = [  //esta en DocumentTrait.php
    'payment_form_id' => 1,      // forma de pago = contado
    'payment_method_id' => 10,   // metodo de pago = efectivo
  ];

  public static function setdepruebas(Router $router){
    session_start();
    isadmin();
    $alertas = [];

    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
      //obtener usuario
      $user = users::find('id', $idusers);
      //obtener compañia
      $company = companies::find('id', $idcompany);
      //obtener tipo de documento o factura. ej: factura electronica, nota credito etc
      $typeDocument = type_documents::find('id', $type_document_id);
      //obtener el cliente final o consumidor
      $customer = new users($customerAll);
      $customer->company = new companies($customerAll);
      //obtener resolucion y numeracion
      $resolution = resolutions::uniquewhereArray(['company_id'=>$idcompany, 'type_document_id'=>$data['tipofactura'], 'resolution'=>$data['resolution'], 'prefix'=>$data['prefix']]);
      $resolution->number = $number;
      //fecha y hora
      $data = date("Y-m-d");
      $time = date("H:i:s");
      //forma de pago
      $paymentFormAll = (object) array_merge(self::$paymentFormDefault, $payment_form ?? []);
      $paymentForm = payment_forms::find('id', $paymentFormAll->payment_form_id);
      $paymentForm->payment_method_code = payment_methods::find('id', $paymentFormAll->payment_method_id)->code;
      $paymentForm->payment_due_date = $paymentFormAll->payment_due_date ?? null;
      $paymentForm->duration_measure = $paymentFormAll->duration_measure ?? null;
      //cargos y descuentos
      $cargosDescuentos = [];
      foreach ($_POST['cargosDescuentos'] ?? [] as $cargoDescuento) {
        array_push($cargosDescuentos, new AllowanceCharge($cargoDescuento));
      }
      //impuestos
      $taxTotals = collect();
      foreach ($request->tax_totals ?? [] as $taxTotal) {
          $taxTotals->push(new TaxTotal($taxTotal));
      }
      //totales monetarios
      //lineas de factura (registro de los productos o servicios facturados)
      //crear el xml
      //firmar XML digitalmente
      //preparar y enviar a Dian pruebas
      //respuesta

            
    }
    //$alertas = usuarios::getAlertas();
    $router->render('admin/factura/setdepruebas', ['titulo'=>'setdepruebas', 'alertas'=>$alertas, 'user'=>$_SESSION/*'negocio'=>negocio::get(1)*/]);   //  'autenticacion/login' = carpeta/archivo
  }


}