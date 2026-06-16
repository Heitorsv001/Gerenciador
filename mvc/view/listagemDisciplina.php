<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Disciplinas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Listagem de Disciplinas</h1>
<a class="btn btn-primary mb-3" href="<?= APP ?>/disciplina/novo">Nova Disciplina</a>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Código</th><th>Nome</th><th>Editar</th><th>Excluir</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($usuarios as $disciplina): ?>
    <tr>
        <td><?= $disciplina['id'] ?></td>
        <td><?= htmlspecialchars($disciplina['codigo']) ?></td>
        <td><?= htmlspecialchars($disciplina['nome']) ?></td>
        <td><a class="btn btn-warning btn-sm" href="<?= APP ?>/disciplina/editar/<?= $disciplina['id'] ?>">Editar</a></td>
        <td>
            <a class="btn btn-danger btn-sm"
               href="<?= APP ?>/disciplina/excluir/<?= $disciplina['id'] ?>"
               onclick="return confirm('Excluir disciplina?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
