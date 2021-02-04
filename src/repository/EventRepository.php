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

        session_start();

        $assignedById = $_SESSION['id'];

        $stmt->execute([
            $event->getTitle(),
            $event->getDescription(),
            $event->getImage(),
            $date->format('Y-m-d'),
            $assignedById
        ]);

        //przeniesienie na strone glowna po dodaniu projektu
        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/events");
    }

    public function getEvents(): array
    {
        $result = [];
        //pobieramy z bazy danych wszystkie wydarzenia zawarte w tabelce events
        $stmt = $this->database->connect()->prepare('SELECT * FROM events;');

        //wykonanie zapytania
        $stmt->execute();
        //wynik zapytania przypisuje do tymczasowej zmiennej
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($events as $event) {
            //przypisanie nowego obiektu wydarzenia, przekazuje za pomoca iterowanego obiektu
            //odpowiednie argumenty do konstruktora
            $result[] = new Event($event['title'], $event['description'], $event['image'], $event['like'], $event['id']);
        }

        //zwrócenie wyniku jako lista wszystkich wydarzen
        return $result;
    }

    //wyszukiwanie wydarzen po ich nazwie
    public function getEventsTitle(string $searchString)
    {
        //nadpisanie zmiennej, zmiana liter na male, mozliwosc wyszukawania podanego hasla
        //w srodku nazwy danego projektu
        $searchString = '%' . strtolower($searchString) . '%';

        //zapytanie do bazy danych o nazwy wydarzen ktore pasuja do podanego zapytania
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM events WHERE LOWER(title) LIKE :search OR LOWER(description) LIKE :search
        ');
        // w miejsce klucza search wstawiamy wyszukiwane przez nas haslo
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        //wykonanie
        $stmt->execute();

        //zwraca tablice asocjacyjna
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //funkcja odpowiedzialna za aktualizacje serduszek w projekcie
    public function like(int $id) {
        // statement, inkrementacja kolumny like
        $stmt = $this->database->connect()->prepare('
            UPDATE events SET "like" = "like" + 1 WHERE id = :id
         ');

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}