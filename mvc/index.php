<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define("APP", "http://localhost/Gerenciador/mvc");

include 'system/Database.php';
include 'system/Model.php';
include 'system/Controller.php';
include 'model/Aluno.php';
include 'model/Professor.php';
include 'model/Permanencia.php';
include 'model/Usuario.php';
include 'controller/AlunoController.php';
include 'controller/ProfessorController.php';
include 'controller/PermanenciaController.php';
include 'controller/LoginController.php';

$url = $_GET['url'] ?? '';

// proteção de rotas — depois de $url ser definida
$rotasPublicas = ['login/index', 'login/entrar'];
if (!isset($_SESSION['usuario']) && !in_array($url, $rotasPublicas)) {
    header('location: ' . APP . '/login/index');
    exit;
}

if ($url == '') {
    include 'view/home.php';
    exit;
}

$partes = explode('/', $url);
$nomeControlador = ucfirst($partes[0]) . 'Controller';
$acao = $partes[1];
$controlador = new $nomeControlador();

if (count($partes) == 2) {
    $controlador->$acao();
} else {
    $id = $partes[2];
    $controlador->$acao($id);
}
?>