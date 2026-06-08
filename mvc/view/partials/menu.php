<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= APP ?>">Sistema Web Maria</a>
    <div class="navbar-nav me-auto">
      <a class="nav-link" href="<?= APP ?>/aluno/listar">Aluno</a>
      <a class="nav-link" href="<?= APP ?>/professor/listar">Professor</a>
      <a class="nav-link" href="<?= APP ?>/permanencia/listar">Permanência</a>
    </div>
    <?php if (!empty($_SESSION['usuario'])): ?>
    <div class="navbar-nav">
      <span class="nav-link text-light"><?= $_SESSION['usuario'] ?></span>
      <a class="nav-link text-danger" href="<?= APP ?>/login/sair">Sair</a>
    </div>
    <?php endif; ?>
  </div>
</nav>