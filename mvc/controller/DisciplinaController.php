<?php
include_once 'system/Controller.php';

class DisciplinaController extends Controller {

    function __construct() {
        $this->model        = new Disciplina();
        $this->nomeEntidade = 'disciplina';
    }

    function novo() {
        $dados = ['id' => 0, 'nome' => '', 'codigo' => ''];
        include 'view/formularioDisciplina.php';
    }
}
?>
