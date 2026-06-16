<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?= APP ?>">Sistema Gerenciador</a>
    <div class="navbar-nav me-auto">
      <a class="nav-link" href="<?= APP ?>/aluno/listar">Alunos</a>
      <a class="nav-link" href="<?= APP ?>/professor/listar">Professores</a>
      <a class="nav-link" href="<?= APP ?>/permanencia/listar">Permanência</a>
      <a class="nav-link" href="<?= APP ?>/disciplina/listar">Disciplinas</a>
    </div>
    <?php if (!empty($_SESSION['usuario'])): ?>
    <div class="navbar-nav">
      <span class="nav-link text-light"><?= $_SESSION['usuario'] ?></span>
      <a class="nav-link text-danger" href="<?= APP ?>/login/sair">Sair</a>
    </div>
    <?php endif; ?>
  </div>
</nav>
