<?php
include_once 'core/Model.php';

class Permanencia extends Model {
    protected $table = 'permanencia';

    public function getAll(): array {
        $sql = "SELECT p.*, prof.nome AS professor
                FROM permanencia p
                JOIN professor prof ON p.id_professor = prof.id
                ORDER BY p.dia_semana";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarProfessores(): array {
        $sql  = "SELECT id, nome FROM professor ORDER BY nome";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>