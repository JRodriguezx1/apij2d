<?php

use DOMDocument;

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
        $templatePath = __DIR__ . "/../views/templates/xml/{$data['typeDocument']['code']}.xml";
        $DOMDocumentXML = new DOMDocument();
        $DOMDocumentXML->preserveWhiteSpace = false;
        $DOMDocumentXML->formatOutput = true;
        $DOMDocumentXML->loadXML(view("xml.{$data['typeDocument']['code']}", $data)->render());

        return $DOMDocumentXML;
    } catch (InvalidArgumentException $e) {
        throw new Exception("The API does not support the type of document '{$data['typeDocument']['name']}' Error: {$e->getMessage()}");
    } catch (Exception $e) {
        throw new Exception("Error: {$e->getMessage()}");
    }
}
