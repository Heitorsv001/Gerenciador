<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Permanências</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Listagem de Permanências</h1>
<a class="btn btn-primary" href="novo">Novo</a>

<table class="table">
<thead>
<tr>
    <th>ID</th>
    <th>Professor</th>
    <th>Dia</th>
    <th>Início</th>
    <th>Fim</th>
    <th>Sala</th>
    <th>Excluir</th>
    <th>Editar</th>
</tr>
</thead>

<tbody>
<?php foreach ($usuarios as $usuario): ?>
<tr>
    <td><?= $usuario['id'] ?></td>
    <td><?= $usuario['professor'] ?></td>
    <td><?= $usuario['dia_semana'] ?></td>
    <td><?= $usuario['hora_inicio'] ?></td>
    <td><?= $usuario['hora_fim'] ?></td>
    <td><?= $usuario['sala'] ?></td>

    <td><a class="btn btn-danger" href="excluir/<?= $usuario['id'] ?>">x</a></td>
    <td><a class="btn btn-primary" href="editar/<?= $usuario['id'] ?>">+</a></td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
</body>
</html>