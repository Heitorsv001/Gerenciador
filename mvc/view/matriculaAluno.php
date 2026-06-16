<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Matrículas — <?= htmlspecialchars($aluno['nome']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Matrículas de <?= htmlspecialchars($aluno['nome']) ?></h1>
<a class="btn btn-secondary mb-4" href="<?= APP ?>/aluno/listar">← Voltar</a>

<div class="row">

    <div class="col-md-6">
        <h4>Disciplinas matriculadas</h4>
        <?php if (empty($matriculadas)): ?>
            <p class="text-muted">Nenhuma disciplina ainda.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr><th>Código</th><th>Nome</th><th>Remover</th></tr>
                </thead>
                <tbody>
                <?php foreach ($matriculadas as $d): ?>
                <tr>
                    <td><?= htmlspecialchars($d['codigo']) ?></td>
                    <td><?= htmlspecialchars($d['nome']) ?></td>
                    <td>
                        <a class="btn btn-danger btn-sm"
                           href="<?= APP ?>/aluno/desmatricular/<?= $aluno['id'] ?>-<?= $d['id'] ?>"
                           onclick="return confirm('Remover matrícula?')">Remover</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <h4>Matricular em nova disciplina</h4>
        <?php if (empty($disponiveis)): ?>
            <p class="text-muted">Aluno já está matriculado em todas as disciplinas.</p>
        <?php else: ?>
            <form action="<?= APP ?>/aluno/matricular" method="post">
                <input type="hidden" name="id_aluno" value="<?= $aluno['id'] ?>">
                <div class="mb-3">
                    <label class="form-label">Selecione a disciplina</label>
                    <select class="form-select" name="id_disciplina" required>
                        <option value="">-- escolha --</option>
                        <?php foreach ($disponiveis as $d): ?>
                            <option value="<?= $d['id'] ?>">
                                <?= htmlspecialchars($d['codigo']) ?> — <?= htmlspecialchars($d['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-success">Matricular</button>
            </form>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
