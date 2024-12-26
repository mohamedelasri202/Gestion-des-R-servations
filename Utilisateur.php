<?php

class Utilisateur {
    private $id;
    private $name;
    private $email;
    private $password;
    private $id_role;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Méthode pour inscrire un utilisateur
    public function sInscrire($name, $email, $password, $id_role) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Hachage du mot de passe
            $query = "INSERT INTO utilisateur (name, email, password, id_role) VALUES (:name, :email, :password, :id_role)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':password' => $hashedPassword,
                ':id_role' => $id_role
            ]);
            echo "Utilisateur inscrit avec succès.";
        } catch (PDOException $e) {
            echo "Erreur lors de l'inscription : " . $e->getMessage();
        }
    }

    // Méthode pour connecter un utilisateur
    // public function seConnecter($email, $password) {
    //     try {
    //         $query = "SELECT * FROM utilisateur WHERE email = :email";
    //         $stmt = $this->pdo->prepare($query);
    //         $stmt->execute([':email' => $email]);

    //         $user = $stmt->fetch();
    //         if ($user && password_verify($password, $user['password'])) {
    //             session_start();
    //             $_SESSION['user_id'] = $user['id'];
    //             $_SESSION['user_role'] = $user['id_role'];

    //             // Redirection selon le rôle
    //             if ($user['id_role'] == 1) {
    //                 header("Location: indix.php"); // Page admin
    //             } else {
    //                 header("Location: home.php"); // Page client
    //             }
    //             exit;
    //         } else {
    //             echo "Identifiants incorrects.";
    //         }
    //     } catch (PDOException $e) {
    //         echo "Erreur lors de la connexion : " . $e->getMessage();
    //     }
    // }

    public function seConnecter($email, $password) {
      try {
          $query = "SELECT * FROM utilisateur WHERE email = :email";
          $stmt = $this->pdo->prepare($query);
          $stmt->execute([':email' => $email]);
  
          // Vérifier si l'utilisateur existe
          $user = $stmt->fetch(PDO::FETCH_ASSOC);
          if (!$user) {
              echo "Aucun utilisateur trouvé avec cet email.";
              return;
          }
  
          // Vérifier le mot de passe
          if (password_verify($password, $user['password'])) {
              session_start();
              $_SESSION['user_id'] = $user['id'];
              $_SESSION['user_role'] = $user['id_role'];
  
              // Redirection selon le rôle
              if ($user['id_role'] == 1) {
                  header("Location: dashboord.php"); // Page admin
              } else {
                  header("Location: home.php"); // Page client
              }
              exit;
          } else {
              echo "Identifiants incorrects.";
          }
      } catch (PDOException $e) {
          echo "Erreur lors de la connexion : " . $e->getMessage();
      }
  }
  
}

?>
