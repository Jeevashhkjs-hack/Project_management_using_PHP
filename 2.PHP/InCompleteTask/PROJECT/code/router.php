<?php
require 'controller/userController.php';
class router{
    public $controller;
    public function __construct()
    {
        $this->controller = new userController();
    }

    public function get($uri,$action){
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'GET',
            'middleware' => null
        ];
        return $this;
    }

    public function post($uri,$action){
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'POST',
            'middleware' => null
        ];
        return $this;
    }

    public function delete($uri,$action){
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'DELETE',
            'middleware' => null
        ];
        return $this;
    }

    public function patch($uri,$action){
        $this->router[] = [
            'uri' => $uri,
            'action' => $action,
            'method' => 'PATCH',
            'middleware' => null
        ];
        return $this;
    }

    public function routingFunc(){

        foreach ($this->router as $key) {
            if($key['uri'] === $_SERVER['REQUEST_URI']){

                if($key['action']){
                    switch ($key['action']){
                        case 'createProject':
                            $this->controller->insertProject($_POST);
                            break;
                        case 'getTasks':
                            $this->controller->getAllTasks($_POST['tarId']);
                            break;
                        case 'taskView':
                            $this->controller->taskView($_POST['tarId']);
                            break;
                        case 'addTask':
                            $this->controller->insertTask($_POST,$_FILES['userImg']);
                            break;
                        case 'undeletedTask':
                            $this->controller->undeletedTask();
                            break;
                        case 'delete':
                            $this->controller->delete($_POST['id']);
                            break;
                        case 'deletedTask':
                            $this->controller->deletedTask();
                            break;

                        default :
                            $this->controller->getAllProject($_POST);
                    }
                }
            }
        }
        exit();
    }
}