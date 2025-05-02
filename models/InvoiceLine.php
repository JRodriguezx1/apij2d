<?php

namespace Model;

class InvoiceLine extends ActiveRecord{
    //protected static $tabla = 'InvoiceLine';
    //protected static $columnasDB = ['id', 'idusuario', 'id_caja', 'id_cierrecaja', 'operacion', 'fecha', 'valor', 'descripcion'];
    
    public $unit_measure_id;
    public $type_item_identification_id;
    public $reference_price_id;

    public $invoiced_quantity;
    public $line_extension_amount;
    public $free_of_charge_indicator;
    public $description;
    public $code;
    public $price_amount;
    public $base_quantity;

    protected $allowance_charges = [];
    protected $tax_totals = [];

    // Relacion (like $with in Laravel)
    public $unit_measure;
    public $type_item_identification;
    public $reference_price;
    
    public function __construct(array $args = []){
        
        $this->unit_measure_id = $args['unit_measure_id'] ?? null;
        $this->type_item_identification_id = $args['type_item_identification_id'] ?? null;
        $this->reference_price_id = $args['reference_price_id'] ?? null;

        $this->invoiced_quantity  = $args['invoiced_quantity ']??0;
        $this->line_extension_amount  = $args['line_extension_amount ']??0;
        $this->free_of_charge_indicator  = $args['free_of_charge_indicator ']??false;
        $this->description  = $args['description ']??'';
        $this->code  = $args['code ']??'';
        $this->price_amount  = $args['price_amount ']?? 0;
        $this->base_quantity  = $args['base_quantity ']??1;

        $this->setAllowanceCharges($args['allowance_charges'] ?? []);
        $this->setTaxTotals($args['tax_totals'] ?? []);

        //LLAMADO DE LAS RELACIONES
        $this->unit_measure = $this->getUnitMeasure();
        $this->type_item_identification = $this->getTypeItemIdentification();
        $this->reference_price = $this->getReferencePrice();
    }

///////////MUTADORES Y ACCESORES ///////////////
    public function setAllowanceCharges(array $args = [])
    {
        foreach ($args as $value) {
            $this->allowance_charges[] = new AllowanceCharge($value);
        }
    }

    public function getAllowanceCharges()
    {
        return $this->allowance_charges??[];
    }

    public function setTaxTotals(array $args = [])
    {
        foreach ($args as $value) {
            $this->tax_totals[] = new TaxTotal($value);
        }
    }

    public function getTaxTotals()
    {
        return $this->tax_totals??[];
    }

    public function getFreeOfChargeIndicator()
    {
        return $this->free_of_charge_indicator ? 'true' : 'false';
    }


    ////////// CARGA AUTOMATICA DE TABLAS db ////////////
    public function getUnitMeasure()
    {
        return unit_measures::find('id', $this->unit_measure_id);
    }

    public function getTypeItemIdentification()
    {
        return type_item_identifications::find('id', $this->type_item_identification_id);
    }

    public function getReferencePrice()
    {
        return reference_prices::find('id', $this->reference_price_id);
    }

}

?>