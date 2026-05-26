<?php

class Database {

    private static $conexao;

    public static function getConnection() {

        if (!self::$conexao) {

            self::$conexao = new PDO(
                "pgsql:host=localhost;port=5432;dbname=gerenciador",
                "postgres",
                "postgres"
            );

            self::$conexao->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
        }

        return self::$conexao;
    }
}
?>