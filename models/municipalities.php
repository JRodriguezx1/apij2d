<?php

namespace Model;

class municipalities extends ActiveRecord {
    protected static $tabla = 'municipalities';
    protected static $columnasDB = ['id', 'department_id', 'name', 'code', 'created_at', 'updated_at'];
    
    protected $with = ['departments'];

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->department_id = $args['department_id'] ?? '';
        $this->name = $args['name']??NULL;
        $this->code = $args['code'] ?? '';
        $this->created_at = $args['created_at'] ?? '';
        $this->updated_at = $args['updated_at'] ?? '';
    }


    public function departments(){
        return departments::find('id', $this->department_id);
    }

}