<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<div class="row justify-content-center">
<div class="col-md-4">

    <h2 class="mb-4 text-center">Login</h2>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?= $erro ?></div>
    <?php endif; ?>

    <form action="<?= APP ?>/login/entrar" method="post">
        <div class="mb-3">
            <label>Usuário</label>
            <input type="text" class="form-control" name="email" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" class="form-control" name="senha" required>
        </div>
        <button class="btn btn-primary w-100">Entrar</button>
    </form>

</div>
</div>

</body>
</html>