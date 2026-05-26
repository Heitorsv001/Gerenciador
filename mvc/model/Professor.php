<?php
include_once 'core/Model.php';
class Professor extends Model {

    function getAll() {
        $conexao = $this->getConnection();
        $sql = 'SELECT * FROM professor ORDER BY nome';
        $stmt = $conexao->query($sql, PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function insert($dados) {
        $conexao = $this->getConnection();
        $sql = 'INSERT INTO professor(nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":email", $dados['email']);
        $stmt->bindParam(":senha", $dados['senha']);
        $stmt->execute();
    }

    function update($dados) {
        $conexao = $this->getConnection();
        $sql = 'UPDATE professor SET nome=:nome, email=:email, senha=:senha WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":email", $dados['email']);
        $stmt->bindParam(":senha", $dados['senha']);
        $stmt->bindParam(":id", $dados['id']);
        $stmt->execute();
    }

    function delete($id) {
        $conexao = $this->getConnection();
        $sql = 'DELETE FROM professor WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function getById($id) {
        $conexao = $this->getConnection();
        $sql = 'SELECT * FROM professor WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>