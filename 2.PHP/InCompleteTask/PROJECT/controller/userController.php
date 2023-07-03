<?php
require 'model/userModel.php';

unset($_SESSION['projectPage']);
class userController{
    public $modelDb;
    public function __construct()
    {
        $this->modelDb = new userModel();
    }

    public function insertProject($getProData,$img){
        if($getProData){
            $lastProId = $this->modelDb->insertProject($getProData['projectName']);

                $count = count($img['name']);
                $path = 'view/UserImages/';

                for($i=0;$i<$count;$i++){
                    $destinatin = $path.$img['name'][$i];
                    $tmpFle = $img['tmp_name'][$i];
                    move_uploaded_file($tmpFle,$destinatin);
                    $this->modelDb->insertProImg($destinatin,$lastProId);
                }

            unset($_SESSION['projectPage']);
            $projects = $this->modelDb->getAllProjects();
            // header('location: /');
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

            $cnt = count($img['name']);
            $path = 'view/UserImages/';

            for($i=0;$i<$cnt;$i++){
                $destinatin = $path.$img['name'][$i];
                $tmpFle = $img['tmp_name'][$i];
                move_uploaded_file($tmpFle,$destinatin);
                $this->modelDb->insertTask($taskName,$taskDes,$destinatin,$_SESSION['projectId']);
            }
            header('location:/');
        }
        else{
            require 'view/Task Form.php';
        }
    }
    public function undeletedTask(){
        $projects = $this->modelDb->getAllProjects();
        $datas = $this->modelDb->undeleted($_SESSION['projectId']);
        $undeleteCn = $this->modelDb->count($_SESSION['projectId']);
        $deleCnt = $this->modelDb->deletedCount($_SESSION['projectId']);
        require 'view/initialPage.php';
    }
    public function deletedTask(){
        $projects = $this->modelDb->getAllProjects();
        $datas = $this->modelDb->deleteTask($_SESSION['projectId']);
        $undeleteCn = $this->modelDb->count($_SESSION['projectId']);
        $deleCnt = $this->modelDb->deletedCount($_SESSION['projectId']);
        require 'view/initialPage.php';
    }
    public function delete($id){
        $count = $this->modelDb->delete($id,$_SESSION['projectId']);
        header('location: /');
    }
}