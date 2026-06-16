<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Listagem de Alunos</h1>
<a class="btn btn-primary mb-3" href="<?= APP ?>/aluno/novo">Novo</a>

<table class="table table-bordered">
<thead class="table-dark">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Inscrições</th>
    <th>Editar</th>
    <th>Excluir</th>
</tr>
</thead>
<tbody>
<?php foreach ($usuarios as $usuario): ?>
<tr>
    <td><?= $usuario['id'] ?></td>
    <td><?= htmlspecialchars($usuario['nome']) ?></td>
    <td><?= htmlspecialchars($usuario['email']) ?></td>
    <td>
        <a class="btn btn-success btn-sm"
           href="<?= APP ?>/aluno/inscricoes/<?= $usuario['id'] ?>">
           Inscrições
        </a>
    </td>
    <td><a class="btn btn-warning btn-sm" href="<?= APP ?>/aluno/editar/<?= $usuario['id'] ?>">Editar</a></td>
    <td>
        <a class="btn btn-danger btn-sm"
           href="<?= APP ?>/aluno/excluir/<?= $usuario['id'] ?>"
           onclick="return confirm('Excluir aluno?')">Excluir</a>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</body>
</html>
