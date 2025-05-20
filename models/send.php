<?php
namespace Model;

class send extends ActiveRecord {
    protected static $tabla = 'send';
    protected static $columnasDB = ['id', 'company_id', 'type_document_id', 'year', 'next_consecutive', 'created_at', 'updated_at'];

    public $id;
    public $company_id;
    public $type_document_id;
    public $year;
    public $next_consecutive;  //por defecto en la DB empieza desde uno "1"
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->company_id = $args['company_id'] ?? '';
        $this->type_document_id = $args['type_document_id'] ?? '';
        $this->year = $args['year'] ?? date("Y");
        $this->next_consecutive = $args['next_consecutive'] ?? 1;   //por defecto es uno "1" en la DB
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']?? '';
    }

}