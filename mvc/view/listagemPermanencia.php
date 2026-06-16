<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permanências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Listagem de Permanências</h1>
    <a class="btn btn-danger" href="<?= APP ?>/permanencia/pdf">📄 Gerar PDF</a>
</div>

<a class="btn btn-primary mb-3" href="<?= APP ?>/permanencia/novo">Nova Permanência</a>

<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Professor</th><th>Dia</th>
            <th>Início</th><th>Fim</th><th>Sala</th>
            <th>Editar</th><th>Excluir</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($usuarios as $usuario): ?>
    <tr>
        <td><?= $usuario['id'] ?></td>
        <td><?= htmlspecialchars($usuario['professor']) ?></td>
        <td><?= htmlspecialchars($usuario['dia_semana']) ?></td>
        <td><?= substr($usuario['hora_inicio'], 0, 5) ?></td>
        <td><?= substr($usuario['hora_fim'],    0, 5) ?></td>
        <td><?= htmlspecialchars($usuario['sala']) ?></td>
        <td><a class="btn btn-warning btn-sm" href="<?= APP ?>/permanencia/editar/<?= $usuario['id'] ?>">Editar</a></td>
        <td>
            <a class="btn btn-danger btn-sm"
               href="<?= APP ?>/permanencia/excluir/<?= $usuario['id'] ?>"
               onclick="return confirm('Excluir permanência?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
