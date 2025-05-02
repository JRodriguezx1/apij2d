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

    public $is_fixed_value;  //impuesto de valor fijo o por unidad

    public $tax;
    public $unit_measure;

    public function __construct($args = []){

        $this->tax_id = $args['tax_id']??null;                        //FK al impuesto (IVA, retención, etc.)    -------------------> si allowance_charges esta presente se requiere
        $this->unit_measure_id = $args['unit_measure_id']??null;      //FK a la unidad de medida     -------------------------------> si tax_id == 10 se requiere
        $this->percent = $args['percent']??0;                         //Porcentaje del impuesto    ---------------------------------> si tax_id != 10 se requiere
        $this->tax_amount = $args['tax_amount']??0;                   //Monto del impuesto    --------------------------------------> si allowance_charges esta presente se requiere
        $this->taxable_amount = $args['taxable_amount']??0;           //Monto sobre el que se calcula el impuesto    ---------------> si allowance_charges esta presente se requiere
        $this->base_unit_measure = $args['base_unit_measure']??null;  //Cantidad base sobre la que se aplica (para unitarios)   ----> si tax_id == 10 se requiere
        $this->per_unit_amount = $args['per_unit_amount']??0;         //Valor del impuesto por unidad    ---------------------------> si tax_id == 10 se requiere

        $this->is_fixed_value = $this->getIsFixedValue();             //true si el impuesto es fijo por unidad (cuando tax_id = 10)

        $this->taxes();
        $this->unitmeasure();
    }


    public function getIsFixedValue() //si es fijo o proporcional
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

/*
Caso 1: tax_id = 19, sin allowance_charges
$data = [
    'tax_id' => 19,
    'percent' => 19,
    'tax_amount' => 3800,
    'taxable_amount' => 20000,
    // No se requiere unit_measure_id, per_unit_amount ni base_unit_measure
];

Caso 2: tax_id = 10, requiere valores por unidad
$data = [
    'tax_id' => 10,
    'unit_measure_id' => 2,
    'per_unit_amount' => 1900,
    'base_unit_measure' => 1,
    'tax_amount' => 1900,
    'taxable_amount' => 20000,
];

Caso 3: tax_id ≠ 10 con allowance_charges
$data = [
    'tax_id' => 5,
    'percent' => 16,
    'tax_amount' => 300,
    'taxable_amount' => 1875,
];

Caso 4: Cuando tax_id = 10 sin allowance_charges
{
    "tax_totals": [
        {
            "tax_id": 10,
            "unit_measure_id": 1,
            "per_unit_amount": 2.5,
            "base_unit_measure": 100
        }
    ]
}

Caso 4: Cuando tax_id = 10 con allowance_charges
{
    "tax_totals": [
        {
            "tax_id": 10,
            "unit_measure_id": 3,
            "per_unit_amount": 0.50,
            "base_unit_measure": 100,
            "tax_amount": 50,
            "taxable_amount": 100
        }
    ],
    "allowance_charges": true
}

Caso 5: Cuando tax_id ≠ 10 sin allowance_charges
{
    "tax_totals": [
        {
            "percent": 18  // Obligatorio (tax_id ≠ 10)
            // Los demás campos son opcionales
        }
    ],
}

Caso 6: Cuando tax_id ≠ 10 sin allowance_charges
{
    "tax_totals": [
        {
            "tax_id": 5,  // Opcional (pero si se envía, debe existir en la DB)
            "percent": 18
        }
    ],
}

Caso 7: Cuando tax_id ≠ 10 sin allowance_charges
{
    "tax_totals": [
        {
            "tax_id": 5,
            "percent": 18,
            "tax_amount": 36,       // Opcional (sin allowance_charges)
            "taxable_amount": 200   // Opcional (sin allowance_charges)
        }
    ]
}
*/

?>