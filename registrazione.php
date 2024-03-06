<?php

namespace Registrazione {
    use PDO;
    use Utenti\Utente;
    class User {
        private PDO $conn;

            public function __construct(PDO $conn) {
                $this->conn = $conn;
            }

            // public function getAll() {
            //     $sql = 'SELECT * FROM biblioteca.materialebibliotecario WHERE tipo = "Libro"';
            //     $res = $this->conn->query($sql, PDO::FETCH_ASSOC);
            //     return $res ? $res : null;
            // }
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

            // public function updateLibro(Libro $libro) {
            //     $sql = "UPDATE biblioteca.materialebibliotecario SET titolo = :titolo, annoPubblicazione = :annoPubblicazione, autore = :autore WHERE id = :id";
            //     $stm = $this->conn->prepare($sql);
            //     $stm->execute([
            //                     'titolo' => $libro->titolo, 
            //                     'annoPubblicazione' => $libro->annoPubblicazione, 
            //                     'autore' => $libro->autore, 
            //                     'id' => $libro->id]);
            //     return $stm->rowCount();
            // }
            // public function deleteLibro(int $id) {
            //     $sql = "DELETE FROM biblioteca.materialebibliotecario WHERE id = :id";
            //     $stm = $this->conn->prepare($sql);
            //     $stm->execute(['id' => $id]);
            //    return $stm->rowCount();
            // }
    }
}