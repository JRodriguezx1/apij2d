<?php

namespace Model;

class type_item_identifications extends ActiveRecord{
    protected static $tabla = 'type_item_identifications';
    protected static $columnasDB = ['id', 'name', 'code', 'code_agency', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->name = $args['name']??'';
        $this->code = $args['code']??'';
        $this->code_agency = $args['code_agency']??'';
        $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at'] ?? '';
    }

}
?>