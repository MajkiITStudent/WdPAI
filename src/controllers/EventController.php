<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Event.php';
require_once __DIR__.'/../repository/EventRepository.php';

class EventController extends AppController
{

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';

    private $messages = [];
    private $eventRepository;

    public function __construct()
    {
        parent::__construct();
        $this->eventRepository = new EventRepository();
    }

    // wyswietlanie wszystkich wydarzen zawartych w eventRepository
    public function events(){
        $events = $this->eventRepository->getEvents();
        //zmienna z pobranymi widokami w postaci tablicy asocjacyjnej przekazujemy na widok
        $this->render('mainpage', ['events' => $events]);
    }

    public function addEvent()
    {
        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])){

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $event = new Event($_POST['title'],$_POST['description'],$_FILES['file']['name']);
            $this->eventRepository->addEvent($event);


            return $this->render('mainpage', ['messages' => $this->message, 'events' => $this->eventRepository->getEvents()]);
        }

        return $this->render('addevent', ['messages' => $this->message]);
    }

    public function search()
    {
        /*$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            echo json_encode($this->projectRepository->getProjectByTitle($decoded['search']));
        }*/
    }

    private function validate(array $file){
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->message[] = 'File is too large for destination file system.';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->message[] = 'File type is not supported.';
            return false;
        }
        return true;
    }


}