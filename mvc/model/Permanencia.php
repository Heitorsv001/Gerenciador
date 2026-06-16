<?php
class Permanencia{

    function getConnection() {
        try {
            $conexao = new PDO(
                'pgsql:host=localhost;port=5432;dbname=Gerenciador',
                'postgres',
                'postgres'
            );
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexao;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    function getAll() {
        $conexao = $this->getConnection();
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
        $stmt->bindParam(":dia_semana",   $dados['dia_semana']);
        $stmt->bindParam(":hora_inicio",  $dados['hora_inicio']);
        $stmt->bindParam(":hora_fim",     $dados['hora_fim']);
        $stmt->bindParam(":sala",         $dados['sala']);
        $stmt->execute();
    }

    function update($dados) {
        $conexao = $this->getConnection();
        $sql = 'UPDATE permanencia 
                SET id_professor=:id_professor, dia_semana=:dia_semana, hora_inicio=:hora_inicio, hora_fim=:hora_fim, sala=:sala 
                WHERE id=:id';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_professor", $dados['id_professor']);
        $stmt->bindParam(":dia_semana",   $dados['dia_semana']);
        $stmt->bindParam(":hora_inicio",  $dados['hora_inicio']);
        $stmt->bindParam(":hora_fim",     $dados['hora_fim']);
        $stmt->bindParam(":sala",         $dados['sala']);
        $stmt->bindParam(":id",           $dados['id']);
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
        $sql = 'SELECT p.*, prof.nome AS professor
                FROM permanencia p
                JOIN professor prof ON p.id_professor = prof.id
                WHERE p.id = :id';
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

    // Retorna permanências em que o aluno NÃO está inscrito
    function getPermanenciasDisponiveis($idAluno) {
        $conexao = $this->getConnection();
        $sql = 'SELECT p.*, prof.nome AS professor
                FROM permanencia p
                JOIN professor prof ON p.id_professor = prof.id
                WHERE p.id NOT IN (
                    SELECT id_permanencia FROM aluno_permanencia WHERE id_aluno = :id_aluno
                )
                ORDER BY p.dia_semana';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_aluno", $idAluno);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Retorna permanências em que o aluno JÁ está inscrito
    function getPermanenciasDoAluno($idAluno) {
        $conexao = $this->getConnection();
        $sql = 'SELECT p.*, prof.nome AS professor
                FROM permanencia p
                JOIN professor prof ON p.id_professor = prof.id
                JOIN aluno_permanencia ap ON ap.id_permanencia = p.id
                WHERE ap.id_aluno = :id_aluno
                ORDER BY p.dia_semana';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_aluno", $idAluno);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inscreve o aluno na permanência
    function inscrever($idAluno, $idPermanencia) {
        $conexao = $this->getConnection();
        $sql = 'INSERT INTO aluno_permanencia (id_aluno, id_permanencia) VALUES (:id_aluno, :id_permanencia)';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_aluno",       $idAluno);
        $stmt->bindParam(":id_permanencia", $idPermanencia);
        $stmt->execute();
    }

    // Cancela inscrição do aluno na permanência
    function cancelarInscricao($idAluno, $idPermanencia) {
        $conexao = $this->getConnection();
        $sql = 'DELETE FROM aluno_permanencia WHERE id_aluno = :id_aluno AND id_permanencia = :id_permanencia';
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":id_aluno",       $idAluno);
        $stmt->bindParam(":id_permanencia", $idPermanencia);
        $stmt->execute();
    }
}
?>
