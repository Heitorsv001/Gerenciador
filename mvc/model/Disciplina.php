<?php
include_once 'system/Model.php';

class Disciplina extends Model {
    protected $table = 'disciplina';

    public function getDisciplinasPorAluno(int $idAluno): array {
        $sql  = "SELECT d.*
                 FROM disciplina d
                 JOIN aluno_disciplina ad ON ad.id_disciplina = d.id
                 WHERE ad.id_aluno = :id_aluno
                 ORDER BY d.nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_aluno', $idAluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDisciplinasDisponiveis(int $idAluno): array {
        $sql  = "SELECT d.*
                 FROM disciplina d
                 WHERE d.id NOT IN (
                     SELECT id_disciplina FROM aluno_disciplina WHERE id_aluno = :id_aluno
                 )
                 ORDER BY d.nome";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_aluno', $idAluno, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function matricular(int $idAluno, int $idDisciplina): void {
        $sql  = "INSERT INTO aluno_disciplina (id_aluno, id_disciplina) VALUES (:id_aluno, :id_disciplina)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_aluno',      $idAluno,      PDO::PARAM_INT);
        $stmt->bindValue(':id_disciplina', $idDisciplina, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function desmatricular(int $idAluno, int $idDisciplina): void {
        $sql  = "DELETE FROM aluno_disciplina WHERE id_aluno = :id_aluno AND id_disciplina = :id_disciplina";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_aluno',      $idAluno,      PDO::PARAM_INT);
        $stmt->bindValue(':id_disciplina', $idDisciplina, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>
