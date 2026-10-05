<?php

$projectPath = dirname(__DIR__);

require_once($projectPath . "/vendor/mustache/Mustache/Autoloader.php");
Mustache_Autoloader::register();

require_once($projectPath . "/helper/MyDatabase.php");
require_once($projectPath . "/helper/MustacheRender.php");
require_once($projectPath . "/helper/Router.php");
require_once(__DIR__ . "/model/LugaresModel.php");
require_once(__DIR__ . "/controller/LugaresController.php");

require_once(__DIR__ . "/model/ReservaModel.php");
require_once(__DIR__ . "/controller/ReservaController.php");

require_once(__DIR__ . "/model/EventoModel.php");
require_once(__DIR__ . "/controller/EventoController.php");

require_once(__DIR__ . "/model/LoginModel.php");
require_once(__DIR__ . "/controller/LoginController.php");

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

        $config = parse_ini_file(dirname(__DIR__) . "/config/config.ini");
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
