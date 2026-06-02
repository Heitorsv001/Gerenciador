<?php
include_once 'system/Controller.php';

class AlunoController extends Controller {

    function __construct() {
        $this->model = new Aluno();
        $this->nomeEntidade = 'aluno';
    }

    function novo() {
        $dados = ['id' => 0, 'nome' => '', 'email' => '', 'senha' => ''];
        include "view/formularioAluno.php";
    }
}
?>