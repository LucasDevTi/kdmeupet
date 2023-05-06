<?php

class Banco{

    public function conectar(){
        try {
            $pdo = new PDO("mysql:host=".HOST.";dbname=".DB_NAME."", DB_USER, DB_PASS);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }
}