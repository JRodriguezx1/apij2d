<?php

namespace Model;

class companies extends ActiveRecord {
    protected static $tabla = 'companies';
    protected static $columnasDB = ['id', 'user_id', 'identification_number', 'dv', 'language_id', 'tax_id', 'type_environment_id', 'payroll_type_environment_id', 'eqdocs_type_environment_id', 'type_operation_id', 'type_document_identification_id', 'country_id', 'type_currency_id', 'type_organization_id', 'type_regime_id', 'type_liability_id', 'municipality_id', 'merchant_registration', 'address', 'phone', 'password', 'newpassword', 'type_plan_id', 'type_plan2_id', 'type_plan3_id', 'type_plan4_id', 'absolut_plan_documents', 'start_plan_date', 'start_plan_date2', 'start_plan_date3', 'start_plan_date4', 'absolut_start_plan_date', 'state', 'allow_seller_login', 'created_at', 'updated_at'];
    
    protected $with = ['software', 'certificate', 'resolutions', 'languages', 'taxes', 'type_environments', 'type_operations', 'type_document_identifications', 'country', 'type_currencies', 'type_organizations', 'type_regimes', 'type_liabilities', 'municipalities'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->user_id = $args['user_id'] ?? '';
        $this->identification_number = $args['identification_number'] ?? '';
        $this->dv = $args['dv'] ?? '';
        $this->language_id = $args['language_id'] ?? 79;
        $this->tax_id = $args['tax_id'] ?? 1;
        $this->type_environment_id = $args['type_environment_id'] ?? 2; //2 = modo pruebas
        $this->payroll_type_environment_id = $args['payroll_type_environment_id'] ?? 2;
        $this->eqdocs_type_environment_id = $args['eqdocs_type_environment_id'] ?? 2;
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
        $this->password = $args['password'] ?? '';
        $this->newpassword = $args['newpassword'] ?? '';
        $this->type_plan_id = $args['type_plan_id'] ?? 0;
        $this->type_plan2_id = $args['type_plan2_id'] ?? 0;
        $this->type_plan3_id = $args['type_plan3_id'] ?? 0;
        $this->type_plan4_id = $args['type_plan4_id'] ?? 0;
        $this->absolut_plan_documents = $args['absolut_plan_documents'] ?? '';
        $this->start_plan_date = $args['start_plan_date'] ?? '';
        $this->start_plan_date2 = $args['start_plan_date2'] ?? '';
        $this->start_plan_date3 = $args['start_plan_date3'] ?? '';
        $this->start_plan_date4 = $args['start_plan_date4'] ?? '';
        $this->absolut_start_plan_date = $args['absolut_start_plan_date'] ?? '';
        $this->state = $args['state'] ?? 1;
        $this->allow_seller_login = $args['allow_seller_login']??1;
        $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at'] ?? '';
    }

    // CARGA AUTOMATICA DE RELACION UNO A UNO, ID DE COMPANIES SE PROPAGA A OTRAS TABLAS
    public function languages(){
        return languages::find('id', $this->language_id);
    }
    public function taxes(){
        return taxes::find('id', $this->tax_id);
    }
    public function type_environments(){
        return type_environments::find('id', $this->type_environment_id);
    }
    public function type_operations(){
        return type_operations::find('id', $this->type_operation_id);
    }
    public function type_document_identifications(){
        return type_document_identifications::find('id', $this->type_document_identification_id);
    }
    public function country(){
        return countries::find('id', $this->country_id);
    }
    public function type_currencies(){
        return type_currencies::find('id', $this->type_currency_id);
    }
    public function type_organizations(){
        return type_organizations::find('id', $this->type_organization_id);
    }
    public function type_regimes(){
        return type_regimes::find('id', $this->type_regime_id);
    }
    public function type_liabilities(){
        return type_liabilities::find('id', $this->type_liability_id);
    }
    public function municipalities(){
        return municipalities::find('id', $this->municipality_id);
    }
    public function software(){
        return software::find('company_id', $this->id);
    }
    public function certificate(){
        return certificates::find('company_id', $this->id);
    }
    public function resolutions(){
        return resolutions::find('company_id', $this->id);
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
        }elseif (companies::find('identification_number', $this->identification_number)) {
            self::$alertas['error'][] = 'El numero de identificacion ya está registrado.';
        }
        // Validacion DV
        if(!$this->dv){
            self::$alertas['error'][] = 'El digito verificador es obligatorio';
        }elseif (!is_numeric($this->dv) || strlen($this->dv) != 1){
            self::$alertas['error'][] = 'El digito verificador debe ser de un digito y numerico';
        }
        // Validacion language_id
        if(!$this->language_id){
            self::$alertas['error'][] = 'Idioma es obligatorio';
        }elseif(!languages::find('id', $this->language_id)){
            self::$alertas['error'][] = 'tipo de idioma no encontrada en DB';
        }
        // Validacion tax_id
        if(!$this->tax_id){
            self::$alertas['error'][] = 'El impuesto es obligatorio';
        }elseif(!taxes::find('id', $this->tax_id)){
            self::$alertas['error'][] = 'tipo de impuesto no encontrada en DB';
        }
        // Validacion type_environment_id
        if(!$this->type_environment_id){
            self::$alertas['error'][] = 'Entrono es obligatorio';
        }elseif(!type_environments::find('id', $this->type_environment_id)){
            self::$alertas['error'][] = 'tipo de entorno no encontrada en DB';
        }
        // Validacion payroll_type_environment_id - Opcional
        if(isset($this->payroll_type_environment_id) && $this->payroll_type_environment_id !== null){
            if(!type_environments::find('id', $this->type_environment_id))
                self::$alertas['error'][] = 'payroll_type_environment_id no encontrada en DB';
        }
        // Validacion eqdocs_type_environment_id - Opcional
        if(isset($this->eqdocs_type_environment_id) && $this->eqdocs_type_environment_id!==null){
            if(!type_environments::find('id', $this->eqdocs_type_environment_id))
                self::$alertas['error'][] = 'eqdocs_type_environment_id no encontrada en DB';
        }
        // Validacion type_operation_id
        if(!$this->type_operation_id){
            self::$alertas['error'][] = 'Operacion es obligatorio';
        }elseif(!type_operations::find('id', $this->type_operation_id)){
            self::$alertas['error'][] = 'tipo de operacion no encontrada en DB';
        }
        // Validacion type_document_identification_id
        if(!$this->type_document_identification_id){
            self::$alertas['error'][] = 'El tipo de documento de identidad es obligatorio';
        }elseif(!type_document_identifications::find('id', $this->type_document_identification_id)){
            self::$alertas['error'][] = 'tipo de identificacion no encontrada en DB';
        }
        // Validacion country_id
        if(!$this->country_id){
            self::$alertas['error'][] = 'Pais es obligatorio';
        }elseif(!countries::find('id', $this->country_id)){
            self::$alertas['error'][] = 'Pais no encontrada en DB';
        }
        // Validacion type_currency_id
        if(!$this->type_currency_id){
            self::$alertas['error'][] = 'Moneda es obligatorio';
        }elseif(!type_currencies::find('id', $this->type_currency_id)){
            self::$alertas['error'][] = 'Moneda no encontrada en DB';
        }
        // Validacion type_organization_id
        if(!$this->type_organization_id){
            self::$alertas['error'][] = 'El tipo de organizacion es obligatorio';
        }elseif(!type_organizations::find('id', $this->type_organization_id)){
            self::$alertas['error'][] = 'tipo de organizacion no encontrada en DB';
        }
        // Validacion type_regime_id
        if(!$this->type_regime_id){
            self::$alertas['error'][] = 'El tipo de regimen es obligatorio';
        }elseif(!type_regimes::find('id', $this->type_regime_id)){
            self::$alertas['error'][] = 'tipo de regimen no encontrada en DB';
        }
        // Validacion type_liability_id
        if(!$this->type_liability_id){
            self::$alertas['error'][] = 'El tipo de responsabilidad es obligatorio';
        }elseif(!type_liabilities::find('id', $this->type_liability_id)){
            self::$alertas['error'][] = 'tipo de responsabilidad no encontrada en DB';
        }
        // Validacion municipality_id
        if(!$this->municipality_id){
            self::$alertas['error'][] = 'Municipio es obligatorio';
        }elseif(!municipalities::find('id', $this->municipality_id)){
            self::$alertas['error'][] = 'Municipio no encontrada en DB';
        }
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