<?php
include_once 'system/Controller.php';

class PermanenciaController extends Controller {

    function __construct() {
        $this->model = new Permanencia();
        $this->nomeEntidade = 'permanencia';
    }

    function novo() {
        $dados = ['id' => 0, 'id_professor' => '', 'dia_semana' => '', 'hora_inicio' => '', 'hora_fim' => '', 'sala' => ''];
        $professores = $this->model->listarProfessores();
        include "view/formularioPermanencia.php";
    }

    function editar($id) {
        $dados = $this->model->getById($id);
        $professores = $this->model->listarProfessores();
        include "view/formularioPermanencia.php";
    }
}
?>