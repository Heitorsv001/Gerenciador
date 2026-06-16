<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Inscrições — <?= htmlspecialchars($aluno['nome']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<?php include "view/partials/menu.php"; ?>

<h1>Inscrições de <?= htmlspecialchars($aluno['nome']) ?></h1>
<a class="btn btn-secondary mb-4" href="<?= APP ?>/aluno/listar">← Voltar</a>

<div class="row">

    <!-- Permanências já inscritas -->
    <div class="col-md-6">
        <h4>Permanências inscritas</h4>

        <?php if (empty($inscritas)): ?>
            <p class="text-muted">Nenhuma inscrição ainda.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>Professor</th>
                        <th>Dia</th>
                        <th>Horário</th>
                        <th>Sala</th>
                        <th>Cancelar</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($inscritas as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['professor']) ?></td>
                    <td><?= htmlspecialchars($p['dia_semana']) ?></td>
                    <td><?= substr($p['hora_inicio'], 0, 5) ?> às <?= substr($p['hora_fim'], 0, 5) ?></td>
                    <td><?= htmlspecialchars($p['sala']) ?></td>
                    <td>
                        <a class="btn btn-danger btn-sm"
                           href="<?= APP ?>/aluno/cancelar/<?= $aluno['id'] ?>-<?= $p['id'] ?>"
                           onclick="return confirm('Cancelar inscrição?')">
                           Cancelar
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>

    <!-- Permanências disponíveis para inscrição -->
    <div class="col-md-6">
        <h4>Inscrever em nova permanência</h4>

        <?php if (empty($disponiveis)): ?>
            <p class="text-muted">Nenhuma permanência disponível.</p>
        <?php else: ?>
            <form action="<?= APP ?>/aluno/inscrever" method="post">
                <input type="hidden" name="id_aluno" value="<?= $aluno['id'] ?>">

                <div class="mb-3">
                    <label class="form-label">Selecione a permanência</label>
                    <select class="form-select" name="id_permanencia" required>
                        <option value="">-- escolha --</option>
                        <?php foreach ($disponiveis as $p): ?>
                            <option value="<?= $p['id'] ?>">
                                <?= htmlspecialchars($p['professor']) ?> —
                                <?= htmlspecialchars($p['dia_semana']) ?> —
                                <?= substr($p['hora_inicio'], 0, 5) ?> às <?= substr($p['hora_fim'], 0, 5) ?> —
                                Sala <?= htmlspecialchars($p['sala']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button class="btn btn-success">Inscrever</button>
            </form>
        <?php endif; ?>
    </div>

</div>
</body>
</html>
