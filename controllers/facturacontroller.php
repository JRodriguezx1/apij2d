<?php

namespace Controllers;

use Classes\Email;
use Model\AllowanceCharge;
use Model\usuarios;
use Model\users;
use Model\companies;
use Model\InvoiceLine;
use Model\LegalMonetaryTotal;
use Model\resolutions;
use Model\payment_forms;
use Model\payment_methods;
use Model\TaxTotal;
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

    ////////////////////datos de prueba ///////////////////
    $facturaNumber = '9944' . random_int(10000, 99000);
    $fechaActual = date("Y-m-d");
    $datos = [
      "prefix" => "SETP",
      "number" => $facturaNumber,                        // numero de factura o consecutivo
      "type_document_id" => "1",                         // tipo de documento 1 = factura electronica
      "date" => $fechaActual,
      "time" => "00:00:01",
      "resolution_number" => "18760000001",              // numero de resolucion
      "sendmail" => false,
      "notes" => "Factura Electroncia de pruebas Auto",
      "payment_form" => [
          "payment_form_id" => "1",
          "payment_method_id" => "10",
          "payment_due_date" => $fechaActual,
          "duration_measure" => "0"
      ],
      "customer" => [
          "identification_number" => "222222222222",     // compañia
          "name" => "Consumidor Final",                  // usuario
          "phone" => null,                               // compañia
          "address" => null,                             // compañia
          "type_document_identification_id" => 3,        // compañia, cedula
          "type_organization_id" => 1,                   // compañia, persona juridica
          "municipality_id" => null                      // compañia
      ],
      "invoice_lines" => [
          [
              "unit_measure_id" => "70",
              "invoiced_quantity" => "1.00",
              "line_extension_amount" => "2000.00",
              "free_of_charge_indicator" => false,
              "tax_totals" => [
                  [
                      "tax_id" => 1,
                      "tax_amount" => "0.00",
                      "taxable_amount" => "2000.00",
                      "percent" => "0"
                  ]
              ],
              "description" => "Producto Prueba",
              "code" => "155",
              "type_item_identification_id" => "4",
              "price_amount" => "2000.00",
              "base_quantity" => "1"
          ]
      ],
      "legal_monetary_totals" => [
          "line_extension_amount" => "2000",
          "tax_exclusive_amount" => "2000",
          "tax_inclusive_amount" => "2000",
          "allowance_total_amount" => "0",
          "charge_total_amount" => "0",
          "payable_amount" => "2000"
      ],
      "tax_totals" => [
          [
              "tax_id" => 1,
              "tax_amount" => "0.00",
              "percent" => "0",
              "taxable_amount" => "2000.00"
          ]
      ]
  ];
    //////////////////*************///////////////////

    if($_SERVER['REQUEST_METHOD'] === 'POST' ){
      //obtener compañia
      $company = companies::find('id', $_POST['idcompany']);
      //debuguear($company);
      //obtener usuario
      $user = users::find('id', $company->user_id);
      //obtener tipo de documento o factura. ej: factura electronica, nota credito etc
      $typeDocument = type_documents::find('id', $datos['type_document_id']??1);
      //obtener el cliente final o consumidor
      $customer = new users($datos['customer']);
      $customer->company = new companies($datos['customer']);
      //obtener resolucion y numeracion
      $resolution = resolutions::uniquewhereArray(['company_id'=>$_POST['idcompany'], 'type_document_id'=>$datos['type_document_id'], 'resolution'=>$datos['resolution_number'], 'prefix'=>$datos['prefix']]);
      $resolution->number = $datos['number'];
      //fecha y hora
      $date = $fechaActual;
      $time = date("H:i:s");
      //forma de pago
      $paymentFormAll = (object) array_merge(self::$paymentFormDefault, $datos['payment_form'] ?? []);  //$datos['payment_form'] me trae tambien "payment_due_date", "duration_measure"
      $paymentForm = payment_forms::find('id', $paymentFormAll->payment_form_id);
      $paymentForm->payment_method_code = payment_methods::find('id', $paymentFormAll->payment_method_id)->code;
      $paymentForm->payment_due_date = $paymentFormAll->payment_due_date ?? null;
      $paymentForm->duration_measure = $paymentFormAll->duration_measure ?? null;
      //cargos y descuentos
      $allowanceCharges = [];
      foreach ($datos['allowance_charges'] ?? [] as $cargoDescuento) {
        array_push($allowanceCharges, new AllowanceCharge($cargoDescuento));
      }
      //impuestos
      $taxTotals = [];
      foreach ($datos['tax_totals'] ?? [] as $taxTotal) {
          array_push($taxTotals, new TaxTotal($taxTotal));
      }
      //totales monetarios
      $legalMonetaryTotals = new LegalMonetaryTotal($datos['legal_monetary_totals']);
      //lineas de factura (registro de los productos o servicios facturados)
      $invoiceLines = [];
      foreach ($datos['invoice_lines'] ?? [] as $invoiceLine) {
          array_push($invoiceLines, new InvoiceLine($invoiceLine));
      }
      //debuguear(1);
      //crear el xml
      $invoice = createXML(compact('user', 'company', 'customer', 'taxTotals', 'resolution', 'paymentForm', 'typeDocument', 'invoiceLines', 'allowanceCharges', 'legalMonetaryTotals', 'date', 'time'));
      debuguear($invoice);
      //firmar XML digitalmente
      //preparar y enviar a Dian pruebas
      //respuesta

            
    }
    //$alertas = usuarios::getAlertas();
    $companies = companies::all();
      foreach($companies as $index => $value){
        $value->objuser = users::find('id', $value->user_id);
      }
    $router->render('admin/factura/setdepruebas', ['titulo'=>'setdepruebas', 'companies'=>$companies, 'alertas'=>$alertas, 'user'=>$_SESSION/*'negocio'=>negocio::get(1)*/]);   //  'autenticacion/login' = carpeta/archivo
  }


}