<?php 

    class LoginController{
    
    private $model;
    private $render;

    public function __construct($model, $render){
        $this->model = $model;
        $this->render = $render;
    }

    public function login(){

        $usuario = $this->model->auntenticar($_POST['usuario'], $_POST['password']);

        if($usuario == null){
            header("Location: /php-mvc/?error=1");
            exit;
        }

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario'] = $usuario['usuario'];
        header("Location: /php-mvc/");
        exit;
    }

    public function logout(){
        session_destroy();
        header("Location: /php-mvc/");
        exit;
    }
}
