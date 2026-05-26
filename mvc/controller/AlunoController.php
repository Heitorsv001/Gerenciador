<?php
class AlunoController {

    function listar() {
        $model = new Aluno();
        $usuarios = $model->getAll();
        include "view/listagemAluno.php";
    }

    function novo() {
        $dados = array();
        $dados['id'] = 0;
        $dados['nome'] = "";
        $dados['email'] = "";
        $dados['senha'] = "";
        include "view/formularioAluno.php";
    }

    function gravar() {
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['nome'] = $_POST['nome'];
        $dados['email'] = $_POST['email'];
        $dados['senha'] = $_POST['senha'];

        $model = new Aluno();

        if ($dados['id'] == 0) {
            $model->insert($dados);
        } else {
            $model->update($dados);
        }

        header('location: '.APP.'/aluno/listar');
    }

    function excluir($id) {
        $model = new Aluno();
        $model->delete($id);
        header('location: '.APP.'/aluno/listar');
    }

    function editar($id) {
        $model = new Aluno();
        $dados = $model->getById($id);
        include "view/formularioAluno.php";
    }
}
?>