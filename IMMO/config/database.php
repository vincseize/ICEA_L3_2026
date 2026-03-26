<?php
// config/database.php
class Database {
    private $dbFile = __DIR__ . '/../data/immo.db';
    private $pdo;
    
    public function __construct() {
        $this->connect();
        $this->createTables();
    }
    
    private function connect() {
        try {
            // Créer le dossier data s'il n'existe pas
            $dataDir = dirname($this->dbFile);
            if (!file_exists($dataDir)) {
                mkdir($dataDir, 0777, true);
            }
            
            $this->pdo = new PDO("sqlite:" . $this->dbFile);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("PRAGMA foreign_keys = ON");
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    
    private function createTables() {
        
        // Table des clients
        $sql = "
        CREATE TABLE IF NOT EXISTS clients (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nom VARCHAR(100) NOT NULL,
            date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";

        "
        CREATE TABLE IF NOT EXISTS questions (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            texte TEXT NOT NULL,
            type BOOL,
            id_questions INTEGER AUTOINCREMENT,
            date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";


        "
        CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            login VARCHAR(75) NOT NULL,
            password VARCHAR(25) NOT NULL,
            date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        

        $this->pdo->exec($sql);

    }
    
    public function getConnection() {
        return $this->pdo;
    }
}