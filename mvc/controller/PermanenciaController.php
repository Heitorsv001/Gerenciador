<?php
class PermanenciaController {

    function listar() {
        $model = new Permanencia();
        $usuarios = $model->getAll();
        include "view/listagemPermanencia.php";
    }

    function novo() {
        $dados = array();
        $dados['id'] = 0;
        $dados['id_professor'] = "";
        $dados['dia_semana'] = "";
        $dados['hora_inicio'] = "";
        $dados['hora_fim'] = "";
        $dados['sala'] = "";

        $model = new Permanencia();
        $professores = $model->listarProfessores();

        include "view/formularioPermanencia.php";
    }

    function gravar() {
        $dados = array();
        $dados['id'] = $_POST['id'];
        $dados['id_professor'] = $_POST['id_professor'];
        $dados['dia_semana'] = $_POST['dia_semana'];
        $dados['hora_inicio'] = $_POST['hora_inicio'];
        $dados['hora_fim'] = $_POST['hora_fim'];
        $dados['sala'] = $_POST['sala'];

        $model = new Permanencia();

        if ($dados['id'] == 0) {
            $model->insert($dados);
        } else {
            $model->update($dados);
        }

        header('location: '.APP.'/permanencia/listar');
    }

    function excluir($id) {
        $model = new Permanencia();
        $model->delete($id);
        header('location: '.APP.'/permanencia/listar');
    }

    function editar($id) {
        $model = new Permanencia();
        $dados = $model->getById($id);
        $professores = $model->listarProfessores();

        include "view/formularioPermanencia.php";
    }
}
?>