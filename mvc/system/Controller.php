<?php
class Controller {

    protected $model;
    protected $nomeEntidade; // 'aluno', 'professor', 'permanencia'


    function listar() {
        $usuarios = $this->model->getAll();
        include "view/listagem" . ucfirst($this->nomeEntidade) . ".php";
    }


    function gravar() {
        $dados = $_POST;

        if ($dados['id'] == 0) {
            $this->model->insert($dados);
        } else {
            $this->model->update($dados);
        }

        header('location: ' . APP . '/' . $this->nomeEntidade . '/listar');
        exit;
    }


    function excluir($id) {
        $this->model->delete($id);
        header('location: ' . APP . '/' . $this->nomeEntidade . '/listar');
        exit;
    }


    function editar($id) {
        $dados = $this->model->getById($id);
        include "view/formulario" . ucfirst($this->nomeEntidade) . ".php";
    }
}
?>