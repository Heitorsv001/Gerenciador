<?php
include_once 'system/Database.php';

class Model {

    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getConnection();
    }


    public function getAll(): array {
        $sql  = "SELECT * FROM {$this->table} ORDER BY id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function getById($id): array|false {
    $sql  = "SELECT * FROM {$this->table} WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
    public function insert(array $dados): void {
    unset($dados['id']); 

    $colunas      = implode(', ', array_keys($dados));
    $placeholders = implode(', ', array_map(fn($c) => ":$c", array_keys($dados)));

    $sql  = "INSERT INTO {$this->table} ($colunas) VALUES ($placeholders)";
    $stmt = $this->db->prepare($sql);

    foreach ($dados as $coluna => $valor) {
        $stmt->bindValue(":$coluna", $valor);
    }

    $stmt->execute();
}
    public function update(array $dados): void {
        $id = $dados['id'];
        unset($dados['id']);

        $sets = implode(', ', array_map(fn($c) => "$c = :$c", array_keys($dados)));

        $sql  = "UPDATE {$this->table} SET $sets WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        foreach ($dados as $coluna => $valor) {
            $stmt->bindValue(":$coluna", $valor);
        }
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $id): void {
        $sql  = "DELETE FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>