<?php
class LoginController {

    function index() {
        include "view/login.php";
    }

    function entrar() {
    $nome  = $_POST['email']; 
    $senha = $_POST['senha'];

    $model   = new Usuario();
    $usuario = $model->findByNome($nome);

    if ($usuario && md5($senha) === $usuario['senha']) {
        session_start();
        $_SESSION['usuario'] = $usuario['nome'];
        header('location: ' . APP);
        exit;
    }

    $erro = 'Usuário ou senha inválidos.';
    include "view/login.php";
}

    function sair() {
        session_start();
        session_destroy();
        header('location: ' . APP . '/login/index');
        exit;
    }
}
?>