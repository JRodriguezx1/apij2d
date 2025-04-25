<?php

namespace Model;

class certificates extends ActiveRecord{
    protected static $tabla = 'certificates';
    protected static $columnasDB = ['id', 'company_id', 'name', 'password', 'expiration_date', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->company_id = $args['company_id']??'';
        $this->name = $args['name']??'';
        $this->password = $args['password']??'';
        $this->expiration_date = $args['expiration_date']??'';
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']?? '';
    }

    public function validar_nueva_certificate(){
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