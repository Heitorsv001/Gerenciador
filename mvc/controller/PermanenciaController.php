<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include_once 'system/Controller.php';

class PermanenciaController extends Controller {

    function __construct() {
        $this->model        = new Permanencia();
        $this->nomeEntidade = 'permanencia';
    }

    function novo() {
        $dados       = ['id' => 0, 'id_professor' => '', 'dia_semana' => '', 'hora_inicio' => '', 'hora_fim' => '', 'sala' => ''];
        $professores = $this->model->listarProfessores();
        include 'view/formularioPermanencia.php';
    }

    function editar($id) {
        $dados       = $this->model->getById($id);
        $professores = $this->model->listarProfessores();
        include 'view/formularioPermanencia.php';
    }

    // Gravar: salva e dispara e-mail ao criar nova permanência
    function gravar() {
        $dados  = $_POST;
        $isNovo = ($dados['id'] == 0);

        if ($isNovo) {
            $this->model->insert($dados);
        } else {
            $this->model->update($dados);
        }

        if ($isNovo) {
            $professor = $this->model->getProfessorById((int) $dados['id_professor']);
            if ($professor && !empty($professor['email'])) {
                $this->enviarEmailConfirmacao($professor, $dados);
            }
        }

        header('location: ' . APP . '/permanencia/listar');
        exit;
    }

    // Geração de PDF com dompdf
    function pdf() {
        $permanencias = $this->model->getAll();

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);

        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($this->gerarHtmlPdf($permanencias));
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        $dompdf->stream(
            'permanencias_' . date('Ymd_Hi') . '.pdf',
            ['Attachment' => true]
        );
        exit;
    }

    // E-mail de confirmação via PHPMailer
    private function enviarEmailConfirmacao(array $professor, array $dados): void {
        $cfg = require __DIR__ . '/../config/mail.php';

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
            $mail->addAddress($professor['email'], $professor['nome']);

            $mail->isHTML(true);
            $mail->Subject = 'Permanência cadastrada — ' . $dados['dia_semana'];
            $mail->Body    = $this->gerarHtmlEmail($professor, $dados);
            $mail->AltBody = $this->gerarTextoEmail($professor, $dados);

            $mail->send();

        } catch (\PHPMailer\PHPMailer\Exception $e) {
            error_log('Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }

    private function gerarHtmlEmail(array $professor, array $dados): string {
        $inicio = substr($dados['hora_inicio'], 0, 5);
        $fim    = substr($dados['hora_fim'],    0, 5);

        return "
        <div style='font-family:Arial,sans-serif;max-width:520px;margin:0 auto;border:1px solid #dee2e6;border-radius:8px;overflow:hidden'>
          <div style='background:#212529;padding:20px 24px'>
            <h2 style='margin:0;color:#fff;font-size:18px'>Sistema Gerenciador</h2>
            <p style='margin:4px 0 0;color:#adb5bd;font-size:13px'>Confirmação de permanência</p>
          </div>
          <div style='padding:24px'>
            <p style='margin:0 0 16px'>Olá, <strong>{$professor['nome']}</strong>!</p>
            <p style='margin:0 0 20px;color:#495057'>Sua permanência foi cadastrada com sucesso:</p>
            <table style='width:100%;border-collapse:collapse;font-size:14px'>
              <tr style='background:#f8f9fa'>
                <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d;width:40%'><strong>Dia</strong></td>
                <td style='padding:10px 14px;border:1px solid #dee2e6'>{$dados['dia_semana']}</td>
              </tr>
              <tr>
                <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d'><strong>Horário</strong></td>
                <td style='padding:10px 14px;border:1px solid #dee2e6'>{$inicio} às {$fim}</td>
              </tr>
              <tr style='background:#f8f9fa'>
                <td style='padding:10px 14px;border:1px solid #dee2e6;color:#6c757d'><strong>Sala</strong></td>
                <td style='padding:10px 14px;border:1px solid #dee2e6'>{$dados['sala']}</td>
              </tr>
            </table>
            <p style='margin:24px 0 0;font-size:12px;color:#adb5bd'>Este é um e-mail automático. Não responda.</p>
          </div>
        </div>";
    }

    private function gerarTextoEmail(array $professor, array $dados): string {
        $inicio = substr($dados['hora_inicio'], 0, 5);
        $fim    = substr($dados['hora_fim'],    0, 5);

        return "Olá, {$professor['nome']}!\n\n"
             . "Sua permanência foi cadastrada:\n\n"
             . "Dia:     {$dados['dia_semana']}\n"
             . "Horário: {$inicio} às {$fim}\n"
             . "Sala:    {$dados['sala']}\n\n"
             . "Sistema Gerenciador";
    }

    private function gerarHtmlPdf(array $permanencias): string {
        $linhas = '';
        foreach ($permanencias as $p) {
            $linhas .= sprintf(
                '<tr>
                    <td>%d</td><td>%s</td><td>%s</td>
                    <td>%s</td><td>%s</td><td>%s</td>
                </tr>',
                $p['id'],
                htmlspecialchars($p['professor']),
                htmlspecialchars($p['dia_semana']),
                substr($p['hora_inicio'], 0, 5),
                substr($p['hora_fim'],    0, 5),
                htmlspecialchars($p['sala'])
            );
        }

        $total    = count($permanencias);
        $geradoEm = date('d/m/Y \à\s H:i');

        return "<!DOCTYPE html>
<html><head><meta charset='UTF-8'>
<style>
  body  { font-family: DejaVu Sans, sans-serif; font-size:12px; color:#212529; margin:0; }
  .header    { background:#212529; color:#fff; padding:12px 20px 8px; }
  .header h1 { margin:0; font-size:20px; }
  .header .sub { margin:2px 0 0; font-size:10px; color:#adb5bd; }
  .wrap { padding:16px 20px; }
  table { width:100%; border-collapse:collapse; }
  th { background:#343a40; color:#fff; padding:8px 10px; font-size:11px; text-align:center; }
  td { padding:6px 10px; border-bottom:1px solid #dee2e6; text-align:center; }
  td:nth-child(2) { text-align:left; }
  tr:nth-child(even) td { background:#f8f9fa; }
  .footer { text-align:right; font-size:10px; color:#6c757d; margin-top:14px; }
</style>
</head><body>
  <div class='header'>
    <h1>Relatório de Permanências</h1>
    <p class='sub'>Gerado em: {$geradoEm}</p>
  </div>
  <div class='wrap'>
    <table>
      <thead>
        <tr><th>ID</th><th>Professor</th><th>Dia</th><th>Início</th><th>Fim</th><th>Sala</th></tr>
      </thead>
      <tbody>{$linhas}</tbody>
    </table>
    <p class='footer'>Total de registros: {$total}</p>
  </div>
</body></html>";
    }
}
?>
