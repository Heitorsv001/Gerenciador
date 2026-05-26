<?php
include_once 'core/Model.php';
class Permanencia extends Model{
    function getAll() {
        $conexao = $this->db;
        $sql = 'SELECT p.*, prof.nome AS professor 
                FROM permanencia p
                JOIN professor prof ON p.id_professor = prof.id
                ORDER BY p.dia_semana';
        $stmt = $conexao->query($sql, PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    function insert($dados) {
        $conexao = $this->getConnection();
        $sql = 'INSERT INTO permanencia(id_professor, dia_semana, hora_inicio, hora_fim, sala) 
                VALUES (:id_professor, :dia_semana, :hora_inicio, :hora_fim, :sala)';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_professor", $dados['id_professor']);
        $stmt->bindParam(":dia_semana", $dados['dia_semana']);
        $stmt->bindParam(":hora_inicio", $dados['hora_inicio']);
        $stmt->bindParam(":hora_fim", $dados['hora_fim']);
        $stmt->bindParam(":sala", $dados['sala']);
        $stmt->execute();
    }

    function update($dados) {
        $conexao = $this->getConnection();
        $sql = 'UPDATE permanencia 
                SET id_professor=:id_professor, dia_semana=:dia_semana, hora_inicio=:hora_inicio, hora_fim=:hora_fim, sala=:sala 
                WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_professor", $dados['id_professor']);
        $stmt->bindParam(":dia_semana", $dados['dia_semana']);
        $stmt->bindParam(":hora_inicio", $dados['hora_inicio']);
        $stmt->bindParam(":hora_fim", $dados['hora_fim']);
        $stmt->bindParam(":sala", $dados['sala']);
        $stmt->bindParam(":id", $dados['id']);
        $stmt->execute();
    }

    function delete($id) {
        $conexao = $this->getConnection();
        $sql = 'DELETE FROM permanencia WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    }

    function getById($id) {
        $conexao = $this->getConnection();
        $sql = 'SELECT * FROM permanencia WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function listarProfessores() {
        $conexao = $this->getConnection();
        $sql = 'SELECT id, nome FROM professor ORDER BY nome';
        $stmt = $conexao->query($sql, PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }
}
?>