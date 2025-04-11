<?php

namespace Model;

class departments extends ActiveRecord{
    protected static $tabla = 'departments';
    protected static $columnasDB = ['id', 'country_id', 'name', 'code', 'created_at', 'updated_at'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->country_id = $args['country_id']??'';
        $this->name = $args['name']??1;
        $this->code = $args['code']??1;
        $this->created_at = $args['created_at']??1;
        $this->updated_at = $args['updated_at']??'';
    }
}

?>