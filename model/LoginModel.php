<?php

class LoginModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function auntenticar($usuario, $password)
    {
        $usuario = addslashes($usuario);
        $password = addslashes($password);

        $sql = "SELECT id, usuario FROM usuarios
                WHERE usuario = '$usuario' AND password = MD5('$password')
                LIMIT 1";

        return $this->database->queryOne($sql);
    }
}
