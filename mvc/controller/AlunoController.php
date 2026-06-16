<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class AlunoController {

    function listar() {
        $model    = new Aluno();
        $usuarios = $model->getAll();
        include "view/listagemAluno.php";
    }

    function novo() {
        $dados = ['id' => 0, 'nome' => '', 'email' => '', 'senha' => ''];
        include "view/formularioAluno.php";
    }

    function gravar() {
        $dados = [
            'id'    => $_POST['id'],
            'nome'  => $_POST['nome'],
            'email' => $_POST['email'],
            'senha' => $_POST['senha'],
        ];

        $model = new Aluno();

        if ($dados['id'] == 0) {
            $model->insert($dados);
        } else {
            $model->update($dados);
        }

        header('location: ' . APP . '/aluno/listar');
    }

    function excluir($id) {
        $model = new Aluno();
        $model->delete($id);
        header('location: ' . APP . '/aluno/listar');
    }

    function editar($id) {
        $model = new Aluno();
        $dados = $model->getById($id);
        include "view/formularioAluno.php";
    }

    // Tela de inscrições do aluno
    function inscricoes($idAluno) {
        $modelAluno      = new Aluno();
        $modelPermanencia = new Permanencia();

        $aluno      = $modelAluno->getById($idAluno);
        $inscritas  = $modelPermanencia->getPermanenciasDoAluno($idAluno);
        $disponiveis = $modelPermanencia->getPermanenciasDisponiveis($idAluno);

        include "view/inscricaoAluno.php";
    }

    // Inscreve o aluno e envia e-mail
    function inscrever() {
        $idAluno       = (int) $_POST['id_aluno'];
        $idPermanencia = (int) $_POST['id_permanencia'];

        $modelPermanencia = new Permanencia();
        $modelAluno       = new Aluno();

        $modelPermanencia->inscrever($idAluno, $idPermanencia);

        // Busca dados para o e-mail
        $aluno      = $modelAluno->getById($idAluno);
        $permanencia = $modelPermanencia->getById($idPermanencia);

        if (!empty($aluno['email'])) {
            $this->enviarEmailConfirmacao($aluno, $permanencia);
        }

        header('location: ' . APP . '/aluno/inscricoes/' . $idAluno);
    }

    // Cancela inscrição
    function cancelar($params) {
        [$idAluno, $idPermanencia] = explode('-', $params);

        $modelPermanencia = new Permanencia();
        $modelPermanencia->cancelarInscricao((int) $idAluno, (int) $idPermanencia);

        header('location: ' . APP . '/aluno/inscricoes/' . $idAluno);
    }

    // Envia e-mail de confirmação via PHPMailer
    private function enviarEmailConfirmacao($aluno, $permanencia) {
        $cfg  = require __DIR__ . '/../config/mail.php';
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $cfg['host'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $cfg['username'];
            $mail->Password   = $cfg['password'];
            $mail->SMTPSecure = $cfg['encryption'];
            $mail->Port       = $cfg['port'];
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom($cfg['from_email'], $cfg['from_name']);
            $mail->addAddress($aluno['email'], $aluno['nome']);

            $inicio = substr($permanencia['hora_inicio'], 0, 5);
            $fim    = substr($permanencia['hora_fim'],    0, 5);

            $mail->isHTML(true);
            $mail->Subject = 'Inscrição confirmada — ' . $permanencia['dia_semana'];
            $mail->Body    = "
            <div style='font-family:Arial,sans-serif;max-width:520px;margin:0 auto;border:1px solid #dee2e6;border-radius:8px;overflow:hidden'>
              <div style='background:#212529;padding:20px 24px'>
                <h2 style='margin:0;color:#fff;font-size:18px'>Sistema Web Maria</h2>
                <p style='margin:4px 0 0;color:#adb5bd;font-size:13px'>Confirmação de inscrição em permanência</p>
              </div>
              <div style='padding:24px'>
                <p style='margin:0 0 16px'>Olá, <strong>{$aluno['nome']}</strong>!</p>
                <p style='margin:0 0 20px;color:#495057'>Sua inscrição foi confirmada com sucesso. Confira os detalhes:</p>
                <table style='width:100%;border-collapse:collapse;font-size:14px'>
                  <tr style='background:#f8f9fa'>
                    <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d;width:40%'><strong>Professor</strong></td>
                    <td style='padding:10px 14px;border:1px solid #dee2e6'>{$permanencia['professor']}</td>
                  </tr>
                  <tr>
                    <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d'><strong>Dia</strong></td>
                    <td style='padding:10px 14px;border:1px solid #dee2e6'>{$permanencia['dia_semana']}</td>
                  </tr>
                  <tr style='background:#f8f9fa'>
                    <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d'><strong>Horário</strong></td>
                    <td style='padding:10px 14px;border:1px solid #dee2e6'>{$inicio} às {$fim}</td>
                  </tr>
                  <tr>
                    <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d'><strong>Sala</strong></td>
                    <td style='padding:10px 14px;border:1px solid #dee2e6'>{$permanencia['sala']}</td>
                  </tr>
                </table>
                <p style='margin:24px 0 0;font-size:12px;color:#adb5bd'>Este é um e-mail automático. Não responda esta mensagem.</p>
              </div>
            </div>";

            $mail->AltBody = "Olá, {$aluno['nome']}!\n\n"
                           . "Sua inscrição foi confirmada:\n\n"
                           . "Professor: {$permanencia['professor']}\n"
                           . "Dia:       {$permanencia['dia_semana']}\n"
                           . "Horário:   {$inicio} às {$fim}\n"
                           . "Sala:      {$permanencia['sala']}\n\n"
                           . "Sistema Web Maria";

            $mail->send();

        } catch (Exception $e) {
            error_log('Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }
}
?>
