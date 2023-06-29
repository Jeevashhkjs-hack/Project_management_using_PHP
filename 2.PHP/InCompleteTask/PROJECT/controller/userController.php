<?php
require 'model/userModel.php';

unset($_SESSION['projectPage']);
class userController{
    public $modelDb;
    public function __construct()
    {
        $this->modelDb = new userModel();
    }

    public function insertProject($getProData){
        if($getProData){
            $this->modelDb->insertProject($getProData['projectName']);
            unset($_SESSION['projectPage']);
            $projects = $this->modelDb->getAllProjects();
        }else{
            $_SESSION['projectPage'] = 'open';
        }
        require 'view/initialPage.php';
    }
    public function getAllProject(){
        unset($_SESSION['projectId']);
        $projects = $this->modelDb->getAllProjects();
        require 'view/initialPage.php';
    }

    public function getAllTasks($id){
        $_SESSION['projectId'] = $id;
        $projects = $this->modelDb->getAllProjects();
        $datas = $this->modelDb->getTasks($id);
        $undeleteCn = $this->modelDb->count($id);
        $deleCnt = $this->modelDb->deletedCount($id);
        require 'view/initialPage.php';
    }
    public function taskView($id){
        $data = $this->modelDb->taskView($id);
        require 'view/taskView.php';
    }
    public function insertTask($data,$img){
        if($data){
            $taskName = $data['taskName'];
            $taskDes = $data['taskDes'];

            $path = 'view/UserImages/';
            $destinatin = $path.$img['name'];

            move_uploaded_file($img['tmp_name'],$destinatin);
            $this->modelDb->insertTask($taskName,$taskDes,$destinatin,$_SESSION['projectId']);
            header('location:/');
        }
        else{
            require 'view/Task Form.php';
        }
    }
    public function undeletedTask(){
        $projects = $this->modelDb->getAllProjects();
        $datas = $this->modelDb->undeleted($_SESSION['projectId']);
        require 'view/initialPage.php';
    }
    public function deletedTask(){
        $projects = $this->modelDb->getAllProjects();
        $datas = $this->modelDb->deleteTask($_SESSION['projectId']);
        require 'view/initialPage.php';
    }
    public function delete($id){
        $count = $this->modelDb->delete($id,$_SESSION['projectId']);
    }
}