<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Cadastro de Aluno</h1>

<?php if (!empty($erro)): ?>
    <div class="alert alert-danger"><?= $erro ?></div>
<?php endif; ?>

<form action="<?= APP . '/aluno/gravar' ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id"         value="<?= $dados['id'] ?>">
    <input type="hidden" name="foto_atual"  value="<?= $dados['foto'] ?? '' ?>">

    <div class="mb-3">
        <label>Nome</label>
        <input class="form-control" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($dados['email']) ?>">
    </div>

    <div class="mb-3">
        <label>Senha</label>
        <input type="password" class="form-control" name="senha" value="<?= $dados['senha'] ?>">
    </div>

    <div class="mb-3">
        <label>Foto de perfil</label>

        <?php if (!empty($dados['foto'])): ?>
            <div class="mb-2">
                <img src="<?= APP ?>/../uploads/fotos/<?= $dados['foto'] ?>"
                     alt="Foto atual"
                     class="rounded-circle"
                     style="width:80px;height:80px;object-fit:cover;border:2px solid #ccc">
                <small class="text-muted ms-2">Foto atual — envie uma nova para substituir</small>
            </div>
        <?php endif; ?>

        <input type="file" class="form-control" name="foto" accept="image/jpeg,image/png,image/gif,image/webp">
        <div class="form-text">JPG, PNG, GIF ou WEBP · máximo 2 MB</div>
    </div>

    <a class="btn btn-secondary" href="<?= APP ?>/aluno/listar">Cancelar</a>
    <button class="btn btn-primary">Gravar</button>

</form>
</body>
</html>
