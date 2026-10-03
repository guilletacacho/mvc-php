<?php
class EventoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getEvento() {

    $error_login = "";
    $sql_evento = "SELECT * FROM evento LIMIT 1";

    $data = $this->database->queryOne($sql_evento);
    $data["error"] = $error_login;
    $data["fecha_evento_formateada"] = date('d/m/Y H:i', strtotime($data['fecha_evento']));
    $data["logueado"] = isset($_SESSION['usuario']);
    $data["usuario"] = $_SESSION['usuario'] ?? null;

    return $data;
    }
}
