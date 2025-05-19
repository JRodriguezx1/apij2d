<?php
namespace Model;

class send extends ActiveRecord {
    protected static $tabla = 'send';
    protected static $columnasDB = ['id', 'company_id', 'type_document_id', 'year', 'next_consecutive'];

    public $id;
    public $company_id;
    public $type_document_id;
    public $year;
    public $next_consecutive;
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->company_id = $args['company_id'] ?? '';
        $this->type_document_id = $args['type_document_id'] ?? '';
        $this->year = $args['year'] ?? date("Y");
        $this->next_consecutive = $args['next_consecutive'] ?? '';
    }

}