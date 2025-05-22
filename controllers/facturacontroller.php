<?php

namespace Controllers;

require __DIR__ . '/../classes/UBL21dian/src/Traits/DIANTrait.php';
require __DIR__ . '/../classes/UBL21dian/src/Sign.php';
require __DIR__ . '/../classes/UBL21dian/src/XAdES/SignInvoice.php';

require __DIR__ . '/../classes/UBL21dian/src/Client.php'; //llamado por Template.php
require __DIR__ . '/../classes/UBL21dian/src/BinarySecurityToken/SOAP.php'; //llamado por Template.php
require __DIR__ . '/../classes/UBL21dian/src/Templates/CreateTemplate.php';
require __DIR__ . '/../classes/UBL21dian/src/Templates/Template.php';
require __DIR__ . '/../classes/UBL21dian/src/Templates/SOAP/SendTestSetAsync.php';

use Stenfrank\UBL21dian\XAdES\SignInvoice;
//use Stenfrank\UBL21dian\Templates\SOAP\SendBillAsync;
use Stenfrank\UBL21dian\Templates\SOAP\SendTestSetAsync;

use Classes\Email;
use Classes\formrequest;
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

    ////////////////////datos factura de prueba ///////////////////
    $facturaNumber = '9944' . random_int(10000, 99000);
    $fechaActual = date("Y-m-d");
    $datos = [
      "prefix" => "SETP",                                // prefijo
      "number" => $facturaNumber,                        // numero de factura o consecutivo
      "type_document_id" => "1",                         // tipo de documento 1 = factura electronica
      "date" => $fechaActual,
      "time" => "00:00:01",
      "resolution_number" => "18760000001",              // numero de resolucion
      "sendmail" => false,
      "notes" => "Factura Electroncia de pruebas Auto",
      "payment_form" => [
          "payment_form_id" => "1",                      // contado
          "payment_method_id" => "10",                   // efectivo
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
      //validacion Form Request
      $validate = new formrequest($datos, []);
      
      if(empty($validate->errors())){  //valida entrada de datos
        //obtener compañia
        $company = companies::find('id', $_POST['idcompany']);
        //obtener usuario
        $user = users::find('id', $company->user_id);
        //obtener tipo de documento o factura. ej: factura electronica, nota credito etc
        $typeDocument = type_documents::find('id', $datos['type_document_id']??1);
        //obtener el cliente final o consumidor
        $customer = new users($datos['customer']);
        $customer->company = new companies($datos['customer']);
        //obtener resolucion y numeracion
        $resolution = resolutions::uniquewhereArray(['company_id'=>$_POST['idcompany'], 'type_document_id'=>$datos['type_document_id'], 'resolution'=>$datos['resolution_number'], 'prefix'=>$datos['prefix']]);
        $resolution->number = $datos['number'];  //numero de factura/consecutivo
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
        
        //validar datos recibidos antes de armar el XML
        //if()
        
        //crear el xml
        $invoice = createXML(compact('user', 'company', 'customer', 'taxTotals', 'resolution', 'paymentForm', 'typeDocument', 'invoiceLines', 'allowanceCharges', 'legalMonetaryTotals', 'date', 'time'));
        //debuguear($company->certificate->password);
        //firmar XML digitalmente
        $signIN = new SignInvoice($company->certificate->path, $company->certificate->password); //la clase SignInvoice extiende de Sign, cuando se instancia la clase SignInvoice, el constructor de SignInvoice llama al al constructor de su padre Sign.
        $signIN->softwareID = $company->software->identifier;
        $signIN->pin = $company->software->pin;
        $signIN->technicalKey = $resolution->technical_key;
        //$z = $signIN->sign($invoice);  //este metodo llama a loadXML(); de class SignInvoice
        //debuguear($z->xml);
        //echo htmlentities($z->xml);
        //preparar y enviar a Dian pruebas
        $sendTestSetAsync = new SendTestSetAsync($company->certificate->path, $company->certificate->password);
        $sendTestSetAsync->To = $company->software->url; //to esta en Template.php
        $sendTestSetAsync->fileName = "{$resolution->prefix}{$resolution->number}.xml";
        $sendTestSetAsync->contentFile = zipBase64($company, $resolution, $signIN->sign($invoice));
        $sendTestSetAsync->testSetId = $_POST['testSetId'];
        //respuesta
        debuguear($sendTestSetAsync->signToSend()->getResponseToObject());
        //$sendTestSetAsync->signToSend()->getResponseToObject();
      }
    } //fin REQUEST_METHOD

    //$alertas = usuarios::getAlertas();
    $companies = companies::all();
      foreach($companies as $index => $value){
        $value->objuser = users::find('id', $value->user_id);
      }
    $router->render('admin/factura/setdepruebas', ['titulo'=>'setdepruebas', 'companies'=>$companies, 'alertas'=>$alertas, 'user'=>$_SESSION/*'negocio'=>negocio::get(1)*/]);   //  'autenticacion/login' = carpeta/archivo
  }


}