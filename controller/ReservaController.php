<?php

class ReservaController{

    private $model;
    private $render;

    public function __construct($model, $render) {
        $this->model = $model;
        $this->render = $render;
    }

    public function sucess() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /php-mvc/");
            exit;
        }

        $reserva_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        $reserva = $this->model->getReserva($reserva_id);

        if ($reserva === null) {
            header("Location: /php-mvc/");
            exit;
        }

        $this->render->renderiza("exito", $reserva);
    }

    public function show() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /php-mvc/");
            exit;
        }

        $data["reservas"] = $this->model->getReservas();

        $this->render->renderiza("reservas", $data);
    }

    public function mostrarUnLugar() {
        if (!isset($_SESSION['usuario'])) {
        header("Location: /php-mvc/");
        exit;
        }

        $lugar_id = isset($_GET['id']) ? (int)$_GET['id'] : (isset($_POST['lugar_id']) ? (int)$_POST['lugar_id'] : 0);

        $lugar = $this->model->getLugar($lugar_id);

        if ($lugar === null) {
            header("Location: /php-mvc/lugares");
            exit;
        }

        $lugar['precio'] = str_replace('.', '', $lugar['precio']);
        $lugar['precio'] = str_replace(',', '.', $lugar['precio']);
        $lugar['precio'] = number_format((float)$lugar['precio'], 2, ',', '.');

        $this->render->renderiza("reserva", $lugar);

    }

    public function crearReserva(){
        
            $lugar_id = $_POST['lugar_id'] ?? 0;
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];

            $reserva_id = $this->model->crearReserva($nombre,$apellido,$dni,$email,$telefono,$lugar_id);

            header("Location: /php-mvc/reserva/sucess?id=$reserva_id");
            exit;
        }
    }
