<?php

namespace Model;

class caja extends ActiveRecord{
    protected static $tabla = 'caja';
    protected static $columnasDB = ['id', 'idtipoconsecutivo', 'nombre'];
    
    public $tax_id;
    public $unit_measure_id;
    public $percent;
    public $tax_amount;
    public $taxable_amount;
    public $base_unit_measure;
    public $per_unit_amount;

    public function __construct($args = []){
        $this->tax_id = $args['tax_id']??null;
        $this->unit_measure_id = $args['unit_measure_id']??'';
        $this->percent = $args['percent']??'';
        $this->tax_amount = $args['tax_amount']??'';
        $this->taxable_amount = $args['taxable_amount']??'';
        $this->base_unit_measure = $args['base_unit_measure']??'';
        $this->per_unit_amount = $args['per_unit_amount']??'';
    }

    public function getIsFixedValue()
    {
        return $this->tax_id == 10; //true si el impuesto es fijo por unidad (cuando tax_id = 10)
    }
    

}

?>