<?php

namespace Model;

class companies extends ActiveRecord {
    protected static $tabla = 'companies';
    protected static $columnasDB = ['id', 'user_id', 'identification_number', 'dv', 'language_id', 'tax_id', 'type_environment_id', 'type_operation_id', 'type_document_identification_id', 'country_id', 'type_currency_id', 'type_organization_id', 'type_regime_id', 'type_liability_id', 'municipality_id', 'merchant_registration', 'address', 'phone', 'created_at', 'updated_at'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? '';
        $this->identification_number = $args['identification_number'] ?? '';
        $this->dv = $args['dv'] ?? '';
        $this->language_id = $args['language_id'] ?? 79;
        $this->tax_id = $args['tax_id'] ?? 1;
        $this->type_environment_id = $args['type_environment_id'] ?? 2;
        $this->type_operation_id = $args['type_operation_id'] ?? 10;
        $this->type_document_identification_id = $args['type_document_identification_id'] ?? '';
        $this->country_id = $args['country_id'] ?? 46;
        $this->type_currency_id = $args['type_currency_id'] ?? 35;
        $this->type_organization_id = $args['type_organization_id'] ?? '';
        $this->type_regime_id = $args['type_regime_id'] ?? '';
        $this->type_liability_id = $args['type_liability_id'] ?? '';
        $this->municipality_id = $args['municipality_id'] ?? '';
        $this->merchant_registration = $args['merchant_registration'] ?? '';
        $this->address = $args['address'] ?? '';
        $this->phone = $args['phone'] ?? '';
        $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at'] ?? '';
    }

    // Validación para company nuevas
    public function validar_nueva_company() {
        // Validacion NIT
        if(!$this->identification_number){
            self::$alertas['error'][] = 'Numero de indentificacion no existe';
        }elseif(!is_numeric($this->identification_number)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }elseif(strlen($this->identification_number)<1 || strlen($this->identification_number)>15){
            self::$alertas['error'][] = 'Numero de indentificacion debe estar entre 1 y 15 digitos';
        }/*elseif (numeronitYaExiste($data['identification_number'])) {
            self::$alertas['error'][] = 'Este identification_number ya está registrado.';
        }*/
        // Validacion DV
        if(!$this->dv){
            self::$alertas['error'][] = 'El digito verificador es obligatorio';
        }elseif (!is_numeric($this->dv) || strlen($this->dv) != 1){
            self::$alertas['error'][] = 'El digito verificador debe ser de un digito';
        }
        // Validacion type_document_identification_id
        if(!$this->type_document_identification_id){
            self::$alertas['error'][] = 'El tipo de documento es obligatorio';
        }/*elseif(vlidar type_document_identification_id en db)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }*/
        // Validacion type_organization_id
        if(!$this->type_organization_id){
            self::$alertas['error'][] = 'El tipo de documento es obligatorio';
        }/*elseif(vlidar type_document_identification_id en db)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }*/
        // Validacion type_regime_id
        if(!$this->type_regime_id){
            self::$alertas['error'][] = 'El tipo de documento es obligatorio';
        }/*elseif(vlidar type_document_identification_id en db)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }*/
        // Validacion type_liability_id
        if(!$this->type_liability_id){
            self::$alertas['error'][] = 'El tipo de documento es obligatorio';
        }/*elseif(vlidar type_document_identification_id en db)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }*/
        // Validacion municipality_id
        if(!$this->municipality_id){
            self::$alertas['error'][] = 'El tipo de documento es obligatorio';
        }/*elseif(vlidar type_document_identification_id en db)){
            self::$alertas['error'][] = 'Numero de indentificacion no es un numero';
        }*/
        // Validacion merchant_registration
        if (!$this->merchant_registration) {
            self::$alertas['error'][] = "El registro mercantil es obligatorio";
        } elseif (!is_string($this->merchant_registration)) {
            self::$alertas['error'][] = 'El registro mercantil debe ser texto';
        }
        // Validacion address
        if (!$this->address) {
            self::$alertas['error'][] = "La direccion es obligatorio";
        } elseif (!is_string($this->address)) {
            self::$alertas['error'][] = 'La direccion debe ser texto';
        }
        // Validacion phone
        if(!$this->phone){
            self::$alertas['error'][] = 'Numero de telefono no existe';
        }elseif(!is_numeric($this->phone)){
            self::$alertas['error'][] = 'El telefono no es un numero';
        }elseif(strlen($this->phone)<7 || strlen($this->phone)>10){
            self::$alertas['error'][] = 'Numero de telefono debe estar entre 1 y 15 digitos';
        }

        return self::$alertas;
    }
    
}