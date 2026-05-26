<?php
include_once 'core/Model.php';
class Aluno extends Model{
       function getAll() {
        $conexao = $this->getConnection();
        $sql = 'SELECT * FROM aluno ORDER BY nome';
        $stmt = $conexao->query($sql, PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function insert($dados) {
        $conexao = $this->getConnection();
        $sql = 'INSERT INTO aluno(nome, email, senha) VALUES (:nome, :email, :senha)';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":email", $dados['email']);
        $stmt->bindParam(":senha", $dados['senha']);
        $stmt->execute();
    }

    function update($dados) {
        $conexao = $this->getConnection();
        $sql = 'UPDATE aluno SET nome=:nome, email=:email, senha=:senha WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":nome", $dados['nome']);
        $stmt->bindParam(":email", $dados['email']);
        $stmt->bindParam(":senha", $dados['senha']);
        $stmt->bindParam(":id", $dados['id']);
        $stmt->execute();
    }

    function delete($id) {
        $conexao = $this->getConnection();
        $sql = 'DELETE FROM aluno WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function getById($id) {
        $conexao = $this->getConnection();
        $sql = 'SELECT * FROM aluno WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>