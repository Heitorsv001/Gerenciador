<?php
include_once 'system/Controller.php';

class ProfessorController extends Controller {

    function __construct() {
        $this->model = new Professor();
        $this->nomeEntidade = 'professor';
    }

    function novo() {
        $dados = ['id' => 0, 'nome' => '', 'email' => '', 'senha' => ''];
        include "view/formularioProfessor.php";
    }
}
?>