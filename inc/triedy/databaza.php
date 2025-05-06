<?php
    class Databaza {
        private $host = "localhost", $nazov_db = "databaza_SHK_skuska", $uzivatel = "root", $heslo = "", $charset = "utf8", $pdo;

        public function __construct() {
            $pripojenie = "mysql:host={$this->host};dbname={$this->nazov_db};charset={$this->charset}";

            try {
                $this->pdo = new PDO($pripojenie, $this->uzivatel, $this->heslo);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                die ("Nastala chyba pri pokuse o pripojenie k databáze: " . $e->getMessage());
            }
        }
    
        public function __destruct() {
            $this->pdo = null;
        }

        public function getSpojenie() {
            return $this->pdo;
        }
    }
?>