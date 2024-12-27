<?php
require_once('Utilisateur.php');

class SuperAdmin extends Utilisateur {
  public function __construct($pdo) {
      parent::__construct($pdo);
  }

  public function archiverUtilisateur($userId) {
      try {
          $pdo = $this->getPdo(); 
          $query = "UPDATE utilisateur SET status = 'archivé' WHERE id = :id";
          $stmt = $pdo->prepare($query);
          $stmt->execute([':id' => $userId]);
          echo "Utilisateur archivé avec succès.";
      } catch (PDOException $e) {
          echo "Erreur lors de l'archivage de l'utilisateur : " . $e->getMessage();
      }
  }

  public function bannirUtilisateur($userId) {
    try {
        $query = "UPDATE utilisateur SET status = 'banni' WHERE id = :id";
        $stmt = $this->getPdo(); 
        $stmt->execute([':id' => $userId]);
        echo "Utilisateur banni avec succès.";
    } catch (PDOException $e) {
        echo "Erreur lors du bannissement de l'utilisateur : " . $e->getMessage();
    }
}
}


?>
