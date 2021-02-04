<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    //tworzenie obiektu uzytkownika, uzupelnienie go o dane z bazy danych i zwrocenie ich
    public function getUser(string $email): ?User
    {
        //nowe polaczenie z baza danych
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN users_details ud 
            ON u.id_user_details = ud.id WHERE email = :email
        ');
        //podlaczenie parametrow pod stmt
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        //wykonanie stmt
        $stmt->execute();

        //pobranie uzytkownika z bazy do zmiennej tymczasowej
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //gdy uzytkownik nie zostal znaleziony, zwracamy null
        if ($user == false) {
            return null;
        }
        //tworzenie nowego obiektu user na podstawie tablicy asocjacyjnej
        return new User(
            $user['id'],
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users_details (name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, id_user_details)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.users_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        $stmt->bindParam(':name', $user->getName(), PDO::PARAM_STR);
        $stmt->bindParam(':surname', $user->getSurname(), PDO::PARAM_STR);
        $stmt->bindParam(':phone', $user->getPhone(), PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

}