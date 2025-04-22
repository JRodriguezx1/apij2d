<?php

namespace Model;

class type_documents extends ActiveRecord{
    protected static $tabla = "type_documents";
    protected static $columnasDB = ['id', 'name', 'code', 'cufe_algorithm', 'prefix', 'created_at', 'updated_at']; 

    public $id;
    public $name;
    public $code;
    public $cufe_algorithm;
    public $prefix;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id']??null;
        $this->name = $args['name']??'';
        $this->code = $args['code']??'';
        $this->cufe_algorithm = $args['cufe_algorithm']??'';
        $this->prefix = $args['prefix']??'';
        $this->created_at = $args['created_at'] ?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at'] ?? '';
    }

}