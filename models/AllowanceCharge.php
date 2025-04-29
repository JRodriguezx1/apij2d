<?php

namespace Model;

class AllowanceCharge extends ActiveRecord{
    //protected static $tabla = 'AllowanceCharge';
    //protected static $columnasDB = ['discount_id', 'charge_indicator', 'allowance_charge_reason', 'multiplier_factor_numeric', 'amount', 'base_amount'];

    public $discount_id;
    public $charge_indicator;
    public $allowance_charge_reason;
    public $multiplier_factor_numeric;
    public $amount;
    public $base_amount;
    public $discount; //campo virtual
    
    public function __construct($args = []){
        $this->discount_id = $args['discount_id']??null;
        $this->charge_indicator = $args['charge_indicator']?? false;
        $this->allowance_charge_reason = $args['allowance_charge_reason']?? null;
        $this->multiplier_factor_numeric = $args['multiplier_factor_numeric']?? null;
        $this->amount = $args['amount']?? 0;
        $this->base_amount = $args['base_amount ']?? 1;

        $this->loadDiscount();
    }

    /**
     * Devuelve el indicador de cargo como texto "true"/"false"
     */
    public function getChargeIndicator():bool
    {
        return $this->charge_indicator ? 'true' : 'false';
    }

    /**
     * Devuelve el multiplicador en formato 2 decimales, ya sea directo o calculado
     */
    public function getMultiplierFactorNumeric()
    {
        if ($this->multiplier_factor_numeric !== null) 
            return number_format($this->multiplier_factor_numeric, 2, '.', ''); //formato de 2 decimales y punto decimal
        
        if ($this->base_amount == 0)
            return '0.00';
        
        return number_format(($this->amount / $this->base_amount) * 100, 2, '.', '');
        
    }

    /**
     * Simula la relación con un modelo Discount (debes implementar esto tú mismo)
     */
    public function loadDiscount()
    {
        // Aquí debes implementar la lógica para traer el descuento desde base de datos
        $this->discount = discounts::find('id', $this->discount_id);
    }

    /**
     * Devuelve todos los datos como un array (como toArray de Laravel)
     */
    public function toArray()
    {
        return [
            'discount_id' => $this->discount_id,
            'charge_indicator' => $this->getChargeIndicator(),
            'allowance_charge_reason' => $this->allowance_charge_reason,
            'multiplier_factor_numeric' => $this->getMultiplierFactorNumeric(),
            'amount' => $this->amount,
            'base_amount' => $this->base_amount,
        ];
    }

}

?>