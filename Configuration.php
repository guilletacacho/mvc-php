<?php

require_once("helper/MyDatabase.php");
require_once("helper/MustacheRender.php");
require_once("helper/Router.php");
require_once("model/LugaresModel.php");
require_once("controller/LugaresController.php");

require_once("model/ReservaModel.php");
require_once("controller/ReservaController.php");

require_once("model/EventoModel.php");
require_once("controller/EventoController.php");

require_once("model/LoginModel.php");
require_once("controller/LoginController.php");

class Configuration{

    public function __construct(){

    }

    //FUNCIONES PUBLICAS PARA OBTENER CONTROLADORES

    public function getLugaresController(){

        return new LugaresController($this->getLugaresModel(), $this->getRender());
    }

    public function getReservaController(){

        return new ReservaController($this->getReservaModel(), $this->getRender());
    }

    public function getEventoController(){

        return new EventoController($this->getEventoModel(), $this->getRender());
    }
    
    public function getLoginController(){

        return new LoginController($this->getLoginModel(), $this->getRender());
    }
    //IMPORTANTE 
    public function getRouter(){
        return new Router($this,"evento","show");
    }
    //FUNCIONES PRIVADAS PARA OBTENER MODELOS Y RENDER


    private function getLoginModel(){
        return new LoginModel($this->getDatabase());
    }

    private function getEventoModel(){
        return new EventoModel($this->getDatabase());
    }


    private function getLugaresModel(){
        return new LugaresModel($this->getDatabase());
    }

    private function getReservaModel(){
        return new ReservaModel($this->getDatabase());
    }
    
    private function getDatabase(){

        $config = parse_ini_file("config/config.ini");
        return new MyDatabase($config["db_host"],
        $config["db_user"],
        $config["db_pass"],
        $config["db_name"],
        $config["db_port"]
    );
    }

    private function getRender(){
        return new MustacheRender();
    }
}
