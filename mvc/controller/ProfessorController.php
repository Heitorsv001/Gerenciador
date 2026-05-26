<?php
class ProfessorController {

    function listar() {
        $model = new Professor();
        $usuarios = $model->getAll();
        include "view/listagemProfessor.php";
    }

    function novo() {
        $dados = array();
        $dados['id'] = 0;
        $dados['nome'] = "";
        $dados['email'] = "";
        $dados['senha'] = "";
        include "view/formularioProfessor.php";
    }

    function gravar() {
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['email'] = $_POST['email'];
        $dados['senha'] = $_POST['senha'];

        $model = new Professor();

        if ($dados['id'] == 0) {
            $model->insert($dados);
        } else {
            $model->update($dados);
        }

        header('location: '.APP.'/professor/listar');
    }

    function excluir($id) {
        $model = new Professor();
        $model->delete($id);
        header('location: '.APP.'/professor/listar');
    }

    function editar($id) {
        $model = new Professor();
        $dados = $model->getById($id);
        include "view/formularioProfessor.php";
    }
}
?>