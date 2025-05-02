<?php

namespace Classes;

use DateTime;
use Model\countries;
use Model\discounts;
use Model\languages;
use Model\municipalities;
use Model\payment_forms;
use Model\payment_methods;
use Model\taxes;
use Model\type_document_identifications;
use Model\type_documents;
use Model\type_item_identifications;
use Model\type_liabilities;
use Model\type_organizations;
use Model\type_regimes;
use Model\unit_measures;

class formrequest
{
    protected array $data;
    protected array $rules;
    protected array $errors = [];

    // Alertas y Mensajes
    protected static $alertas = [];

    public function __construct(array $data, array $rules)
    {
        $this->data = $data;
        $this->rules = $rules;
        $this->validate();
    }

    protected function validate()
    {
        /*foreach ($this->rules as $field => $rulesString) {
            $rules = explode('|', $rulesString);
            $value = $this->data[$field] ?? null;
            foreach ($rules as $rule) {
                if ($rule === 'required' && ($value === null || $value === '')) {
                    $this->addError($field, "El campo {$field} es obligatorio.");
                }
                if ($rule === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($field, "El campo {$field} debe ser un correo electrónico válido.");
                }
                if ($rule === 'numeric' && !is_numeric($value)) {
                    $this->addError($field, "El campo {$field} debe ser numérico.");
                }
                if (str_starts_with($rule, 'min:')) {
                    $min = (int) explode(':', $rule)[1];
                    if (is_numeric($value)) {
                        if ($value < $min) {
                            $this->addError($field, "El campo {$field} debe ser al menos {$min}.");
                        }
                    } else {
                        if (strlen($value) < $min) {
                            $this->addError($field, "El campo {$field} debe tener al menos {$min} caracteres.");
                        }
                    }
                }
                // Puedes agregar más validaciones aquí como max:, regex:, etc.
            }
        }*/

        // Resolucion

        //type_document_id => tipo de factura si es factura electronica, nota credito etc
        if(!$this->data['type_document_id'] || $this->data['type_document_id']!=1){
            $this::$alertas['error'][] = 'El tipo de documento o factura es incorrecto';
        }elseif(!type_documents::find('id', $this->data['type_document_id'])){
            $this::$alertas['error'][] = 'tipo de documento no encontrada en DB';
        }
        //CONSECUTIVO
        /*if(!$this->data['number']){
            $this::$alertas['error'][] = 'El número consecutivo es obligatorio.';
        }elseif(!is_numeric($this->data['number']) || intval($this->data['number']) != $this->data['number']){
            $this::$alertas['error'][] = 'El número debe ser un entero.';
        }elseif($this->data['number'] < $from || $number > $to){
            $this::$alertas['error'][] = 'El número debe estar entre $from y $to.';
        }*/
        // CUSTOMER - Obligatorio
        if (!is_array($this->data['customer'])){
            $this::$alertas['error'][] = 'El cliente es obligatorio y debe ser un objeto|arreglo.';
        }else{
            //numero de identificacion del conumidor - Obligatorio
            if(!$this->data['customer']['identification_number']){
                $this::$alertas['error'][] = 'Numero de indentificacion no existe';
            }elseif(!is_numeric($this->data['customer']['identification_number'])){
                $this::$alertas['error'][] = 'Numero de indentificacion no es un numero';
            }elseif(strlen($this->data['customer']['identification_number'])<1 || strlen($this->data['customer']['identification_number'])>15){
                $this::$alertas['error'][] = 'Numero de indentificacion debe estar entre 1 y 15 digitos';
            }
            //digito verificador del consumidor - Opcional
            if(($this->data['customer']['dv']??null) && (!is_numeric($this->data['customer']['dv']) || strlen($this->data['customer']['dv']) != 1)){
                $this::$alertas['error'][] = 'El digito verificador debe ser de un digito y numerico';
            }
            //tido de documento de identificacion del consumidor, si cc, nit, pasaporte etc... - Obligatorio
            if(!($this->data['customer']['type_document_identification_id']??null) || (!type_document_identifications::find('id', $this->data['customer']['type_document_identification_id']))){
                $this::$alertas['error'][] = 'El tipo de documento de identidad no encontrado en DB';
            }
            //tido de organizacion del consumidor - Opcional
            if(($this->data['customer']['type_organization_id']??null) && (!type_organizations::find('id', $this->data['customer']['type_organization_id']))){
                $this::$alertas['error'][] = 'El tipo de organizacion no encontrado en DB';
            }
            //idioma del consumidor - Opcional
            if(($this->data['customer']['language_id']??null) && (!languages::find('id', $this->data['customer']['language_id']))){
                $this::$alertas['error'][] = 'El idioma no encontrado en DB';
            }
            //pais del consumidor - Opcional
            if(($this->data['customer']['country_id']??null) && (!countries::find('id', $this->data['customer']['country_id']))){
                $this::$alertas['error'][] = 'El pais no encontrado en DB';
            }
            //municipio del consumidor - Opcional
            if(($this->data['customer']['municipality_id']??null) && (!municipalities::find('id', $this->data['customer']['municipality_id']))){
                $this::$alertas['error'][] = 'El municipio no encontrado en DB';
            }
            //tipo de regimen del consumidor - Opcional
            if(($this->data['customer']['type_regime_id']??null) && (!type_regimes::find('id', $this->data['customer']['type_regime_id']))){
                $this::$alertas['error'][] = 'Tipo de regimen no encontrado en DB';
            }
            //tipo de impuesto del consumidor - Opcional
            if(($this->data['customer']['tax_id']??null) && (!taxes::find('id', $this->data['customer']['tax_id']))){
                $this::$alertas['error'][] = 'Tipo de impuesto no encontrado en DB';
            }
            //tipo de obligacion del consumidor - Opcional
            if(($this->data['customer']['type_liability_id']??null) && (!type_liabilities::find('id', $this->data['customer']['type_liability_id']))){
                $this::$alertas['error'][] = 'Tipo de obligacion no encontrado en DB';
            }
            // name - Obligatorio
            if (!$this->data['customer']['name'] || !is_string($this->data['customer']['name'])) {
                $this::$alertas['error'][] = 'El nombre del consumidor es obligatorio y debe ser texto.';
            }
            // phone - Opcional
            if (($this->data['customer']['phone']??null) && (!is_numeric($this->data['customer']['phone']) || strlen($this->data['customer']['phone']) < 7 || strlen($this->data['customer']['phone']) > 10)) {
                $this::$alertas['error'][] = 'Telefono debe ser un número entre 7 y 10 dígitos.';
            }
            // address - Opcional
            if (($this->data['customer']['address']??null) && !is_string($this->data['customer']['address'])) {
                $this::$alertas['error'][] = 'La dirección es obligatoria.';
            }
            // email - Opcional
            if (isset($this->data['customer']['email']) && !filter_var($this->data['customer']['email'], FILTER_VALIDATE_EMAIL)) {
                $this::$alertas['error'][] = 'El email no es válido.';
            }
            // merchant_registration - Opcional
            if (isset($this->data['customer']['merchant_registration']) && !is_string($this->data['customer']['merchant_registration'])) {
                $this::$alertas['error'][] = 'La matrícula mercantil es obligatoria.';
            }
        }

        //PAYMENT FORM
        if(is_array($this->data['payment_form'])){
            //forma de pago debe existir en DB - No Obligatorio
            if($this->data['payment_form']['payment_form_id'] && !payment_forms::find('id', $this->data['payment_form']['payment_form_id'])){
                $this::$alertas['error'][] = 'No existe la forma de pago en DB.';
            }
            //metodo de pago debe existir en DB - No Obligatorio
            if($this->data['payment_form']['payment_method_id'] && !payment_methods::find('id', $this->data['payment_form']['payment_method_id'])){
                $this::$alertas['error'][] = 'No existe el metodo de pago en DB.';
            }
            // si la forma de pago 'payment_form_id = 2' es credito se requiere payment_due_date y duration_measure
            if($this->data['payment_form']['payment_form_id'] == 2){
                //payment_due_date
                if(!($this->data['payment_form']['payment_due_date']??null)){
                    $this::$alertas['error'][] = 'Campo fecha es obligatorio si la forma de pago es credito.';
                }elseif(!DateTime::createFromFormat('Y-m-d', $this->data['payment_form']['payment_due_date'])){
                    $this::$alertas['error'][] = 'payment_due_date debe tener formato Y-m-d.';
                }
                //duration_measure
                if (!($this->data['payment_form']['duration_measure'])??null) {
                    $errors['payment_form.duration_measure'][] = 'duration_measure es obligatorio si la forma de pago es credito.';
                } elseif (!is_numeric($this->data['payment_form']['duration_measure']) || strlen($this->data['payment_form']['duration_measure']) > 3) {
                    $errors['payment_form.duration_measure'][] = 'duration_measure debe ser un número de máximo 3 dígitos.';
                }
            }else{
                if(isset($this->data['payment_form']['payment_due_date']) && $this->data['payment_form']['payment_due_date']=="" && !DateTime::createFromFormat('Y-m-d', $this->data['payment_form']['payment_due_date'])){
                    $this::$alertas['error'][] = 'payment_due_date debe tener formato Y-m-d.';
                }
            }
        }

        //ALLOWANCE CHARGES
        if (($this->data['allowance_charges']??null) && is_array($this->data['allowance_charges'])){

            foreach ($this->data['allowance_charges'] as $index => $item) {
                
                if (!isset($item['charge_indicator']) || (isset($item['charge_indicator']) && !is_bool($item['charge_indicator']))) {
                    $this::$alertas['error'][] = "charge_indicator debe existir y ser booleano.";
                }
                //Si charge_indicator es false, entonces discount_id es obligatorio y debe existir en la tabla discounts.
                if (isset($item['charge_indicator']) && $item['charge_indicator'] === false && (!isset($item['discount_id']) || !discounts::find('id', $item['discount_id']))) {
                    $this::$alertas['error'][] = "allowance_charges[$index].discount_id requerido si charge_indicator es false y debe existir.";
                }
                // allowance_charge_reason es requerido y debe ser string si allowance_charges esta presente
                if (!$item['allowance_charge_reason'] || !is_string($item['allowance_charge_reason'])) {
                    $this::$alertas['error'][] = "allowance_charges[$index].allowance_charge_reason requerido como string.";
                }
                if (!$item['amount'] || !is_numeric($item['amount'])) {
                    $this::$alertas['error'][] = "allowance_charges[$index].amount requerido como numérico.";
                }
                if (!$item['base_amount'] || !is_numeric($item['base_amount'])) {
                    $this::$alertas['error'][] = "allowance_charges[$index].base_amount requerido como numérico.";
                }
            }
        }
       
        // TAX_TOTAL
        if (($this->data['tax_totals']??null) && is_array($this->data['tax_totals'])) {

            foreach ($this->data['tax_totals'] as $index => $item) {
                /////***'tax_totals.*.tax_id' => 'nullable|required_with:allowance_charges|exists:taxes,id'
                /////***si allowance_charges esta presente, tax_id debe existir y estar en la DB
                if ($this->data['allowance_charges']??null && (!$item['tax_id'] || !taxes::find('id', $item['tax_id']))) {
                    $this::$alertas['error'][] = "Impuesto en tax_totals[$index].tax_id requerido y debe existir.";
                }
                /////***'tax_totals.*.percent' => 'nullable|required_unless:tax_totals.*.tax_id,10|numeric',
                /////***Si tax_id es diferente de 10, entonces percent debe estar presente y ser numérico. y si percent esta presente que sea numerico.
                if (isset($item['tax_id']) && ($item['tax_id'] != 10) && (!isset($item['percent']) || !is_numeric($item['percent']))){
                    $this::$alertas['error'][] = "tax_totals[$index].percent requerido si tax_id es diferente a 10.";
                }elseif($item['tax_id'] == 10 && !is_numeric($item['percent'])){
                    $this::$alertas['error'][] = "tax_totals[$index].El campo 'percent' debe ser numérico si está presente.";
                }
                /////***'tax_totals.*.tax_amount' => 'nullable|required_with:allowance_charges|numeric',
                foreach (['tax_amount','taxable_amount'] as $campo){
                    if($this->data['allowance_charges']??null){
                        // Si hay 'allowance_charges', entonces 'tax_amount, taxable_amount' es obligatorio y debe ser numérico
                        if (!$item[$campo] || !is_numeric($item[$campo])) 
                            $this::$alertas['error'][] = "El campo $campo es obligatorio y debe ser numérico cuando hay allowance_charges.";
                    }else{
                        // Si no hay 'allowance_charges', 'tax_amount, taxable_amount' puede ser nulo, pero si tax_amount existe, debe ser numerico 
                        if($item[$campo] && !is_numeric($item[$campo])) {
                            $this::$alertas['error'][] = "El campo $campo debe ser numérico si está presente.";
                        }
                    }
                }
                /////***'tax_totals.*.unit_measure_id' => 'nullable|required_if:tax_totals.*.tax_id,10|exists:unit_measures,id',
                /////***El campo unit_measure_id es obligatorio solo cuando tax_id es igual a 10. Cuando el campo está presente, debe existir en la tabla unit_measures
                if (isset($item['tax_id']) && $item['tax_id'] == 10 && !isset($item['unit_measure_id'])) {
                    $this::$alertas['error'][] = "unit_measure_id es requerido cuando tax_id es 10";
                }
                // si esta presente unit_measure_id idependiente si es 10 o no, debe existir en DB
                if (isset($item['unit_measure_id']) && !unit_measures::find('id', $item['unit_measure_id'])) {
                    $this::$alertas['error'][] = "El unit_measure_id no existe en DB";
                }
                /////***'tax_totals.*.per_unit_amount' => 'nullable|required_if:tax_totals.*.tax_id,10|numeric',
                /////*** tax_totals.*.base_unit_measure' => 'nullable|required_if:tax_totals.*.tax_id,10|numeric
                //Valida que per_unit_amount exista y sea numérico si tax_id == 10, Valida que sea numérico cuando el campo está presente, nullable: No requiere el campo si tax_id != 10
                foreach (['per_unit_amount','base_unit_measure'] as $campo){
                    if(isset($item['tax_id']) && $item['tax_id'] == 10){
                        if(!isset($item[$campo]) || !is_numeric($item[$campo]))
                            $this::$alertas['error'][] = "El campo per_unit_amount es obligato o debe ser numerico";
                    }elseif(isset($item[$campo]) && !is_numeric($item[$campo])){
                        $this::$alertas['error'][] = "El campo per_unit_amount debe ser numerico";
                    }
                }
            }
        }
        
        //LEGAL MONETARY TOTALS
        if (!is_array($this->data['legal_monetary_totals']) || !isset($this->data['legal_monetary_totals'])){
            $this::$alertas['error'][] = 'legal_monetary_totals obligatorio y debe ser un objeto|arreglo.';
        }else{
            //line_extension_amount
            if(!$this->data['legal_monetary_totals']['line_extension_amount']){
                $this::$alertas['error'][] = 'Campo line_extension_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['line_extension_amount'])){
                $this::$alertas['error'][] = 'Campo line_extension_amount no es un numero';
            }
            //tax_exclusive_amount
            if(!$this->data['legal_monetary_totals']['tax_exclusive_amount']){
                $this::$alertas['error'][] = 'Campo tax_exclusive_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['tax_exclusive_amount'])){
                $this::$alertas['error'][] = 'Campo tax_exclusive_amount no es un numero';
            }
            //tax_inclusive_amount
            if(!$this->data['legal_monetary_totals']['tax_inclusive_amount']){
                $this::$alertas['error'][] = 'Campo tax_inclusive_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['tax_inclusive_amount'])){
                $this::$alertas['error'][] = 'Campo tax_inclusive_amount no es un numero';
            }
            //allowance_total_amount
            if(!isset($this->data['legal_monetary_totals']['allowance_total_amount'])){
                $this::$alertas['error'][] = 'Campo allowance_total_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['allowance_total_amount'])){
                $this::$alertas['error'][] = 'Campo allowance_total_amount no es un numero';
            }
            //charge_total_amount
            if(!isset($this->data['legal_monetary_totals']['charge_total_amount'])){
                $this::$alertas['error'][] = 'Campo charge_total_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['charge_total_amount'])){
                $this::$alertas['error'][] = 'Campo charge_total_amount no es un numero';
            }
            //payable_amount
            if(!$this->data['legal_monetary_totals']['payable_amount']){
                $this::$alertas['error'][] = 'Campo payable_amount no existe';
            }elseif(!is_numeric($this->data['legal_monetary_totals']['payable_amount'])){
                $this::$alertas['error'][] = 'Campo payable_amount no es un numero';
            }
        }

        //INVOICE LINES
        if (!isset($this->data['invoice_lines']) || !is_array($this->data['invoice_lines'])){
            $this::$alertas['error'][] = 'El campo invoice_lines es requerido y debe ser un array.';
        }else{
            foreach ($this->data['invoice_lines'] as $index => $item) {
                
                if(!($item['unit_measure_id']??null) || !unit_measures::find('id', $item['unit_measure_id'])){
                    $this::$alertas['error'][] = 'El campo unit_measure_id es requerido y debe existir en la DB.';
                }
                
                if(!($item['invoiced_quantity']??null) || !is_numeric($item['invoiced_quantity'])){
                    $this::$alertas['error'][] = 'El campo invoiced_quantity es requerido y debe ser numerico';
                }

                if(!($item['line_extension_amount']??null) || !is_numeric($item['line_extension_amount'])){
                    $this::$alertas['error'][] = 'El campo line_extension_amount es requerido y debe ser numerico';
                }

                if(!($item['free_of_charge_indicator']??null) || !is_bool($item['free_of_charge_indicator'])){
                    $this::$alertas['error'][] = 'El campo free_of_charge_indicator es requerido y debe ser boleano';
                }

                //.....

                if(!($item['description']??null) || !is_string($item['allowance_charge_reason'])){
                    $this::$alertas['error'][] = 'El campo description es requerido y debe ser texto.';
                }
                
                if(!($item['code']??null) || !is_string($item['code'])){
                    $this::$alertas['error'][] = 'El campo code es requerido y debe ser texto';
                }

                if(!($item['type_item_identification_id']??null) || !type_item_identifications::find('id', $item['type_item_identification_id'])){
                    $this::$alertas['error'][] = 'El campo type_item_identification_id es requerido y debe existir en la DB';
                }

                if(!($item['price_amount']??null) || !is_numeric($item['price_amount'])){
                    $this::$alertas['error'][] = 'El campo price_amount es requerido y debe ser numerico';
                }

                if(!($item['base_quantity']??null) || !is_numeric($item['base_quantity'])){
                    $this::$alertas['error'][] = 'El campo base_quantity es requerido y debe ser numerico';
                }

            }
        }

        return $this::$alertas;
    }


    public function errors(): array
    {
        return $this::$alertas;
    }
}