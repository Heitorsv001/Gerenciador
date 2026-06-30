<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Listagem de Professores</h1>
<a class="btn btn-primary" href="novo">Novo</a>

<table class="table">
<thead>
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Excluir</th>
    <th>Editar</th>
</tr>
</thead>

<tbody>
<?php foreach ($usuarios as $usuario): ?>
<tr>
    <td><?= $usuario['id'] ?></td>
    <td><?= $usuario['nome'] ?></td>
    <td><?= $usuario['email'] ?></td>
    <td><a class="btn btn-danger" href="excluir/<?= $usuario['id'] ?>">x</a></td>
    <td><a class="btn btn-primary" href="editar/<?= $usuario['id'] ?>">+</a></td>
</tr>
<?php endforeach; ?>
</tbody>

</table>
</body>
</html>