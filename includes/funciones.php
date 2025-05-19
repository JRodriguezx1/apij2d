<?php

//use DOMDocument;

use Model\companies;
use Model\resolutions;
use Model\type_documents;

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function validar_string_url($path):bool{ //retorna bolean
    //return strpos($_SERVER['PATH_INFO']??'/', $path)?true:false;
    return strpos($_SERVER['REQUEST_URI']??'/', $path)?true:false;
}

function isauth():void  //valida si el usuario esta registrao
{
  if(!isset($_SESSION['login'])||$_SESSION['perfil']==null){
      header('Location: /');       //lo redirecciona a la pagina web
  }
}

function isadmin():void
{/*
    if($_SESSION['perfil']!=1){
        header('Location: /');
    }*/
    if($_SESSION['perfil']==NULL){
        header('Location: /');
    }
}

function digitoVerificacionDIAN($nit) {
    if (is_numeric(trim($nit))) {
        $secuencia = array(3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59, 67, 71);
        $d = str_split(trim($nit));
        krsort($d);
        $cont = 0;
        unset($val);
        foreach ($d as $key => $value) {
            $val[$cont] = $value * $secuencia[$cont];
            $cont++;
        }
        $suma = array_sum($val);
        $div = intval($suma / 11);
        $num = $div * 11;
        $resta = $suma - $num;
        if ($resta == 1)
            return $resta;
        else
            if ($resta != 0)
                return 11 - $resta;
            else
                return $resta;
    } else {
        return FALSE;
    }
}


function createXML(array $data)
{
    try {
        $templatePath = __DIR__ . "/../views/templates/xml/{$data['typeDocument']->code}.php";
        if (!file_exists($templatePath)) {
            throw new InvalidArgumentException("Plantilla XML no encontrada para el tipo de documento '{$data['typeDocument']->name}'");
        }

        // Renderizar plantilla PHP con los datos
        $renderedXML = renderTemplate($templatePath, $data);
        //debuguear($renderedXML);

        // Cargar el resultado en DOMDocument
        $DOMDocumentXML = new DOMDocument();
        $DOMDocumentXML->preserveWhiteSpace = false;
        $DOMDocumentXML->formatOutput = true;
        $DOMDocumentXML->loadXML($renderedXML);
        //echo $DOMDocumentXML->saveXML();
        //echo $DOMDocumentXML->saveXML($DOMDocumentXML->documentElement);
        echo htmlentities($DOMDocumentXML->saveXML());
        return $DOMDocumentXML;
    } catch (InvalidArgumentException $e) {
        debuguear($e->getMessage());
    } catch (Exception $e) {
        debuguear($e->getMessage());
    }
}

// Método auxiliar para renderizar archivos PHP como plantillas
function renderTemplate(string $templatePath, array $data): string
{
    ob_start();
    extract($data);
    include $templatePath;
    return ob_get_clean();
}


/////////////// zib54 /////////////////
function zipBase64(companies $company, resolutions $resolution, $signXml){
    
    $xmlDir = __DIR__ . "/../public/build/archivos/xml/{$resolution->company_id}";
    $zipDir = __DIR__ . "/../public/build/archivos/zip/{$resolution->company_id}";

    if(!is_dir($xmlDir))
        mkdir($xmlDir, 0777, true);

    if(!is_dir($zipDir))
        mkdir($zipDir, 0777, true);
    
    $nameXML = getFileName($company, $resolution);
    $nameZip = getFileName($company, $resolution, 6, '.zip');

    $xmlPath = "{$xmlDir}/{$nameXML}";  // => build/archivos/xml/15/01154545500.xml
    file_put_contents($xmlPath, $signXml);

    $pathZIP = "{$zipDir}/{$nameZip}";  // => build/archivos/zip/15/01154545500.zip

    $zip = new ZipArchive();
    if($zip->open($pathZIP, ZipArchive::CREATE) === TRUE) {
            $zip->addFile($xmlPath, $nameXML);
            $zip->close();
    }else{
        debuguear(0);
    }
    //return $ZipBase64Bytes = base64_encode(file_get_contents($pathZIP));
}

function getFileName(array $company, array $resolution, $typeDocumentID = null, $extension = '.xml'){
    $date = new DateTime();
    $prefix = $typeDocumentID===null?$resolution->type_documents->prefix:type_documents::find('id', $typeDocumentID)->prefix; // Simulación

    $year = $date->format('y');
    $nextConsecutive = $this->getNextConsecutive($company['id'], $typeDocumentID ?? $resolution['type_document_id'], $year);

    //$name = "{$prefix}{$NIT}{$ppp}{$year}{$consecutive}.xml";
    $name = "{$prefix}".stuffedString($company->identification_number).$this->ppp.$year.stuffedString($nextConsecutive??1, 8).$extension;

    $this->incrementConsecutive($company['id'], $typeDocumentID ?? $resolution['type_document_id'], $year);
    return $name;
}

function stuffedString($string, $length = 10, $padString = '0', $padType = STR_PAD_LEFT){
    return str_pad($string, $length, $padString, $padType);
}