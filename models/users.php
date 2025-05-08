<?php

namespace Model;

class users extends ActiveRecord{
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'name', 'email', 'email_verified_at', 'password', 'api_token', 'remember_token', 'created_at', 'updated_at', 'id_administrator', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_encryption'];
    
    public function __construct($args = []){
        $this->id = $args['id']??null;
        $this->name = $args['name']??'';
        $this->email = $args['email']??'';
        $this->email_verified_at = $args['email_verified_at']?? date("Y-m-d H:i:s");
        $this->password = $args['password']??'';
        $this->api_token = $args['api_token']??'';
        $this->remember_token = $args['remenber_token']??null;
        $this->created_at = $args['created_at']?? date("Y-m-d H:i:s");
        $this->updated_at = $args['updated_at']??'';
        $this->id_administrator = $args['id_administrator']??null;
        $this->mail_host = $args['mail_host']??null;
        $this->mail_port = $args['mail_port']??null;
        $this->mail_username = $args['mail_username']??null;
        $this->mail_password = $args['mail_password']??null;
        $this->mail_encryption = $args['mail_encryption']??null;
    }


    public function validar_nuevo_user(){
        // Validar NAME
        if (!$this->name) {
            self::$alertas['error'][] = "El nombre o razon social es obligatorio";
        } elseif (!is_string($this->name)) {
            self::$alertas['error'][] = 'El nombre comercial debe ser texto';
        }
        // Validar EMAIL
        if (!$this->email) {
            self::$alertas['error'][] = "El email es obligatorio";
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alertas['error'][] = 'Formato de email inválido.';
        }elseif (users::find('email', $this->email)) {
            self::$alertas['error'][] = 'Este email ya está registrado.';
        }
        return self::$alertas;
    }
}

?>