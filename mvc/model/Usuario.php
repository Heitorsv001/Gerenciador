<?php
class Usuario extends Model {
    protected $table = 'usuarios';

   public function findByNome(string $nome): array|false {
    $sql  = "SELECT * FROM usuario WHERE nome = :nome";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':nome', $nome);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>