<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Cadastro de Professor</h1>

<form action="<?= APP.'/professor/gravar' ?>" method="post">

<div class="mb-3">
    <label>ID</label>
    <input readonly class="form-control" name="id" value="<?= $dados['id'] ?>">
</div>

<div class="mb-3">
    <label>Nome</label>
    <input class="form-control" name="nome" value="<?= $dados['nome'] ?>">
</div>

<div class="mb-3">
    <label>Email</label>
    <input class="form-control" name="email" value="<?= $dados['email'] ?>">
</div>

<div class="mb-3">
    <label>Senha</label>
    <input type="password" class="form-control" name="senha" value="<?= $dados['senha'] ?>">
</div>

<button class="btn btn-primary">Gravar</button>

</form>
</body>
</html>