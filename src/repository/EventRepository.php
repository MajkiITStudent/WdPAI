<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Event.php';

class EventRepository extends Repository
{
    //tworzenie obiektu uzytkownika, uzupelnienie go o dane z bazy danych i zwrocenie ich
    public function getEvent(int $id): ?Event
    {
        //nowe polaczenie z baza danych
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM events WHERE id = :id
        ');
        //podlaczenie parametrow pod stmt
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        //wykonanie stmt
        $stmt->execute();

        //pobranie uzytkownika z bazy do zmiennej tymczasowej
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        //gdy uzytkownik nie zostal znaleziony, zwracamy null
        if ($event == false) {
            return null;
        }
        //tworzenie nowego obiektu user na podstawie tablicy asocjacyjnej
        return new Event(
            $event['title'],
            $event['description'],
            $event['image']
        );
    }

    //funkcja dodajaca wydarzenie
    public function addEvent(Event $event): void
    {
        //aktualna data
        $date = new DateTime();
        //odwolanie do obiektu z utworzonej bazy danych
        $stmt = $this->database->connect()->prepare('
            INSERT INTO events (title, description, image, created_at, id_assigned_by)
            VALUES (?, ?, ?, ?, ?)
        ');

        //do zrobienia, wartosc powinna byc zwracana jako sesja danego uzytkownika
        $assignedById = 1;

        $stmt->execute([
            $event->getTitle(),
            $event->getDescription(),
            $event->getImage(),
            $date->format('Y-m-d'),
            $assignedById
        ]);
    }
}