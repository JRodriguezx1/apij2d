<?php

namespace Model;

class municipalities extends ActiveRecord {
    protected static $tabla = 'municipalities';
    protected static $columnasDB = ['id', 'department_id', 'name', 'code', 'created_at', 'updated_at'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->department_id = $args['department_id'] ?? 1;
        $this->name = $args['name']??NULL;
        $this->code = $args['code'] ?? 1;
        $this->created_at = $args['created_at'] ?? '';
        $this->updated_at = $args['updated_at'] ?? '';
    }

}