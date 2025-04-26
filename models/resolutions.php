<?php

namespace Model;

class resolutions extends ActiveRecord{
    protected static $tabla = 'resolutions';
    protected static $columnasDB = ['id', 'company_id', 'type_document_id', 'prefix', 'resolution', 'resolution_date', 'technical_key', 'from', 'to', 'date_from', 'date_to', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->company_id = $args['company_id']??'';
        $this->type_document_id = $args['type_document_id']??1;
        $this->prefix = $args['prefix']??'';
        $this->resolution = $args['resolution']??'';
        $this->resolution_date = $args['resolution_date']??'';
        $this->technical_key = $args['technical_key']??'';
        $this->from = $args['from']??'';
        $this->to = $args['to']??'';
        $this->date_from = $args['date_from']??'';
        $this->date_to = $args['date_to']??'';
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']?? '';
    }


    
    public function validar_nueva_resolution(){
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