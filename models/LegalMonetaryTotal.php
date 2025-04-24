<?php

namespace Model;

class LegalMonetaryTotal extends ActiveRecord{
    //protected static $tabla = 'LegalMonetaryTotal';
    //protected static $columnasDB = ['id', 'mediopago', 'estado', 'nick'];
    
    public function __construct($args = []){
        $this->line_extension_amount = $args['line_extension_amount']??null;
        $this->tax_exclusive_amount = $args['tax_exclusive_amount']??'';
        $this->tax_inclusive_amount = $args['tax_inclusive_amount']??'';
        $this->allowance_total_amount = $args['allowance_total_amount']??'';
        $this->charge_total_amount = $args['charge_total_amount']??'';
        $this->pre_paid_amount = $args['pre_paid_amount']??'';
        $this->payable_amount = $args['payable_amount']??'';
    }

}

?>