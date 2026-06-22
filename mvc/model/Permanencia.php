<?php
include_once 'system/Model.php';

class Permanencia extends Model {

    protected $table = 'permanencia';


    public function listarProfessores(): array {
        $sql  = 'SELECT id, nome FROM professor ORDER BY nome';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfessorById(int $id): array|false {
        $sql  = 'SELECT id, nome, email FROM professor WHERE id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getAll(): array {
        $sql  = 'SELECT p.*, prof.nome AS professor
                 FROM permanencia p
                 JOIN professor prof ON p.id_professor = prof.id
                 ORDER BY p.dia_semana';
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): array|false {
        $sql  = 'SELECT p.*, prof.nome AS professor
                 FROM permanencia p
                 JOIN professor prof ON p.id_professor = prof.id
                 WHERE p.id = :id';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function getPermanenciasDisponiveis(int $idAluno): array {
        $sql  = 'SELECT p.*, prof.nome AS professor
                 FROM permanencia p
                 JOIN professor prof ON p.id_professor = prof.id
                 WHERE p.id NOT IN (
                     SELECT id_permanencia FROM aluno_permanencia WHERE id_aluno = :id_aluno
                 )
                 ORDER BY p.dia_semana';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_aluno', $idAluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPermanenciasDoAluno(int $idAluno): array {
        $sql  = 'SELECT p.*, prof.nome AS professor
                 FROM permanencia p
                 JOIN professor prof ON p.id_professor = prof.id
                 JOIN aluno_permanencia ap ON ap.id_permanencia = p.id
                 WHERE ap.id_aluno = :id_aluno
                 ORDER BY p.dia_semana';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_aluno', $idAluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inscrever(int $idAluno, int $idPermanencia): void {
        $sql  = 'INSERT INTO aluno_permanencia (id_aluno, id_permanencia) VALUES (:id_aluno, :id_permanencia)';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_aluno',       $idAluno,       PDO::PARAM_INT);
        $stmt->bindParam(':id_permanencia', $idPermanencia, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function cancelarInscricao(int $idAluno, int $idPermanencia): void {
        $sql  = 'DELETE FROM aluno_permanencia WHERE id_aluno = :id_aluno AND id_permanencia = :id_permanencia';
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_aluno',       $idAluno,       PDO::PARAM_INT);
        $stmt->bindParam(':id_permanencia', $idPermanencia, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>