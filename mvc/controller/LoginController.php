<?php
class LoginController {

    function index() {
        include "view/Login.php";
    }

    function entrar() {
        $nome  = $_POST['email'];
        $senha = $_POST['senha'];

        $model   = new Usuario();
        $usuario = $model->findByNome($nome);

        if ($usuario && md5($senha) === $usuario['senha']) {
            $_SESSION['usuario'] = $usuario['nome'];
            header('location: ' . APP);
            exit;
        }

        $erro = 'Usuário ou senha inválidos.';
        include "view/Login.php";
    }

    function sair() {
        session_destroy();
        header('location: ' . APP . '/login/index');
        exit;
    }
}
?>
