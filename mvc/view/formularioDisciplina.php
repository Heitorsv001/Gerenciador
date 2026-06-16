<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Disciplina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Cadastro de Disciplina</h1>

<form action="<?= APP . '/disciplina/gravar' ?>" method="post">

    <input type="hidden" name="id" value="<?= $dados['id'] ?>">

    <div class="mb-3">
        <label>Código</label>
        <input class="form-control" name="codigo" value="<?= htmlspecialchars($dados['codigo']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Nome</label>
        <input class="form-control" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required>
    </div>

    <a class="btn btn-secondary" href="<?= APP ?>/disciplina/listar">Cancelar</a>
    <button class="btn btn-primary">Gravar</button>

</form>
</body>
</html>
