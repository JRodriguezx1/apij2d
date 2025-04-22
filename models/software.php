<?php

namespace Model;

class software extends ActiveRecord{
    protected static $tabla = 'software';
    protected static $columnasDB = ['id', 'company_id', 'identifier', 'pin', 'url', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->company_id = $args['company_id']??'';
        $this->identifier = $args['identifier']??'';
        $this->pin = $args['pin']??12345;
        $this->url = $args['url']??'';
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']?? '';
    }


    public function validar_nueva_software(){
        // Validacion identifier
        if(!$this->identifier){
            self::$alertas['error'][] = 'ID del software obligatorio';
        }elseif(!is_string($this->identifier)){
            self::$alertas['error'][] = 'ID del software debe ser de tipo texto';
        }
        // Validacion pin
        if(!$this->pin){
            self::$alertas['error'][] = 'Pin es obligatorio';
        }elseif(!is_numeric($this->pin)){
            self::$alertas['error'][] = 'El pin debe ser numerico';
        }elseif(strlen($this->pin)!=5){
            self::$alertas['error'][] = 'Numero de pin debe ser de 5 digitos';
        }
        // Validacion url
        if($this->url){
            if(!is_string($this->url)){
                self::$alertas['error'][] = 'error de la URL';
            }
        }

        return self::$alertas;
    }

}

?>