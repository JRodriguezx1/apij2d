<?php

namespace Model;

class TaxTotal extends ActiveRecord{
    //protected static $tabla = 'TaxTotal';
    //protected static $columnasDB = ['id', 'idtipoconsecutivo', 'nombre'];
    
    public $tax_id;
    public $unit_measure_id;
    public $percent;
    public $tax_amount;
    public $taxable_amount;
    public $base_unit_measure;
    public $per_unit_amount;

    public $tax;
    public $unit_measure;

    public function __construct($args = []){
        $this->tax_id = $args['tax_id']??null;
        $this->unit_measure_id = $args['unit_measure_id']??'';
        $this->percent = $args['percent']??'';
        $this->tax_amount = $args['tax_amount']??'';
        $this->taxable_amount = $args['taxable_amount']??'';
        $this->base_unit_measure = $args['base_unit_measure']??'';
        $this->per_unit_amount = $args['per_unit_amount']??'';

        $this->taxes();
        $this->unitmeasure();
    }


    public function getIsFixedValue()
    {
        return $this->tax_id == 10; //true si el impuesto es fijo por unidad (cuando tax_id = 10)
    }

    public function taxes(){
        $this->tax = taxes::find('id', $this->tax_id);
    }
    
    public function unitmeasure(){
        $this->unit_measure = unit_measures::find('id', $this->unit_measure_id);
    }

}

?>