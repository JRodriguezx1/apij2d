<?php

namespace Model;

class type_environments extends ActiveRecord{
    protected static $tabla = 'type_environments';
    protected static $columnasDB = ['id', 'name', 'code', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->name = $args['name']??'';
        $this->code = $args['code']??'';
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']??'';
    }

}