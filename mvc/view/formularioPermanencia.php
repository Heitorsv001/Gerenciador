<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permanência</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Cadastro de Permanência</h1>

<form action="<?= APP.'/permanencia/gravar' ?>" method="post">

<div class="mb-3">
    <label>ID</label>
    <input readonly class="form-control" name="id" value="<?= $dados['id'] ?>">
</div>

<div class="mb-3">
    <label>Professor</label>
    <select class="form-control" name="id_professor">
        <?php foreach ($professores as $p): ?>
            <option value="<?= $p['id'] ?>" 
                <?= ($dados['id_professor'] == $p['id']) ? 'selected' : '' ?>>
                <?= $p['nome'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label>Dia da Semana</label>
    <input class="form-control" name="dia_semana" value="<?= $dados['dia_semana'] ?>">
</div>

<div class="mb-3">
    <label>Hora Início</label>
    <input type="time" class="form-control" name="hora_inicio" value="<?= $dados['hora_inicio'] ?>">
</div>

<div class="mb-3">
    <label>Hora Fim</label>
    <input type="time" class="form-control" name="hora_fim" value="<?= $dados['hora_fim'] ?>">
</div>

<div class="mb-3">
    <label>Sala</label>
    <input class="form-control" name="sala" value="<?= $dados['sala'] ?>">
</div>

<button class="btn btn-primary">Gravar</button>

</form>
</body>
</html>