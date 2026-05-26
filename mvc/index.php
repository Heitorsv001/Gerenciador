<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);
  include 'core/Database.php';
  include 'core/Model.php';
  include 'controller/AlunoController.php';
  include 'model/Aluno.php';
  include 'controller/ProfessorController.php';
  include 'model/Professor.php';  
  include 'controller/PermanenciaController.php';
  include 'model/Permanencia.php';  

  define("APP", "http://localhost/Gerenciador/mvc");

  $url = $_GET['url'] ?? '';

  if ($url == '') {
    include 'view/home.php';
    exit;
  }
  $partes = explode('/', $url);

  $nomeControlador = ucfirst($partes[0]).'Controller';
  $acao = $partes[1];
  $controlador = new $nomeControlador();
  if (count($partes)==2) {
    $controlador->$acao();  
  } else {
    $id = $partes[2];
    $controlador->$acao($id);
  }
  
?>