<?php

class Database {
    private $host = 'localhost';  // Adresse IP du serveur MySQL
    private $db_name = 'agency';  // Nom de la base de données
    private $username = 'root';  // Nom d'utilisateur MySQL
    private $password = 'ichrak';  // Mot de passe MySQL
    private $conn;  // Stocke la connexion PDO

    public function connect() {
        $this->conn = null;

        try {
            // Créer une connexion PDO
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Activer les exceptions en cas d'erreur
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Mode de récupération par défaut : tableau associatif
                PDO::ATTR_EMULATE_PREPARES => false, // Utiliser les requêtes préparées natives si disponible
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);

            // Afficher un message si la connexion est réussie
            echo "Connected successfully";

        } catch (PDOException $e) {
            // Gérer les erreurs de connexion
            echo "Connection failed: " . $e->getMessage();
        }

        return $this->conn;
    }
}

?>
