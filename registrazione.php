<?php

namespace Registrazione {
    use PDO;
    use Utenti\Utente;
    class User {
        private PDO $conn;

            public function __construct(PDO $conn) {
                $this->conn = $conn;
            }
            public function getAllUsers() {
                $sql = 'SELECT * FROM users';
                $stmt = $this->conn->query($sql);
            
                if ($stmt === false) {
                    // Gestisci l'errore nella query
                    return null;
                }
            
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Controlla se ci sono risultati
                if ($results === false) {
                    // Nessun risultato trovato
                    return null;
                }
            
                return $results;
            }

            public function getUserById(int $id) {
                $sql = 'SELECT * FROM users WHERE id = :id';
                $stm = $this->conn->prepare($sql);
                $stm->execute(['id' => $id]);
                return $stm->fetchAll();
            }
            
            public function getUserByEmail(string $email) {
                $sql = 'SELECT * FROM users WHERE email = :email';
                $stm = $this->conn->prepare($sql);
                $stm->execute(['email' => $email]);
                return $stm->fetchAll();
            }
            public function saveUser(Utente $utente) {
                $sql = "INSERT INTO users (name , surname, tel, city, email, password, image ) VALUES (:name , :surname, :tel, :city, :email, :password, :image )";
                $stm = $this->conn->prepare($sql);
                $stm->execute(['name' => $utente->name, 'surname' => $utente->surname, 'tel' => $utente->tel, 'city' => $utente->city, 'email'=> $utente->getEmail(), 'password'=> $utente->getPass(),
                'image'=>$utente->img]);
                return $stm->rowCount();
            }

            public function updateUser(Utente $utente, $id) {
                $sql = "UPDATE users SET name=:name, surname=:surname, tel=:tel, city=:city, email=:email, password=:password, image=:image WHERE id = :id";
                $stm = $this->conn->prepare($sql);
            
                $params = [
                    'name' => $utente->name,
                    'surname' => $utente->surname,
                    'tel' => $utente->tel,
                    'city' => $utente->city,
                    'email' => $utente->getEmail(),
                    'password' => $utente->getPass(),
                    'image' => $utente->img,
                    'id' => $id
                ];
            
                // Associa i parametri
                foreach ($params as $key => $value) {
                    $stm->bindParam(":$key", $params[$key]);
                }
            
                $stm->execute();
                return $stm->rowCount();
            }
            
            public function deleteUser(int $id) {
                $sql = "DELETE FROM users WHERE id = :id";
                $stm = $this->conn->prepare($sql);
                $stm->execute(['id' => $id]);
               return $stm->rowCount();
            }
    }
}