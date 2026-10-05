<?php

class LugaresController{
    
    private $model;
    private $render;

    public function __construct($model, $render) {
        $this->model = $model;
        $this->render = $render;
    }

    public function show() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: /php-mvc/");
            exit;
        }

        $lugares = $this->model->getLugares();
        
        $data = ["lugares" => $lugares, "usuario" => $_SESSION['usuario']];
        $this->render->renderiza("lugares", $data);
        }
}
