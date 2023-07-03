<?php

class connection{
    public $dbConnect;
    public function __construct()
    {
        $this->dbConnect = new PDO('mysql:host=localhost;dbname=project_management','root','jeeva143');
    }
}

class userModel extends connection {
    public function insertProject($getProject){
        $this->dbConnect->query("INSERT INTO projects (project_name) VALUES ('$getProject')");
        $ids = $this->dbConnect->query("SELECT id from projects order by id desc limit 1");
        $count = $ids->fetch(PDO::FETCH_NUM);
        return $count[0];

    }
    public function getAllProjects(){
        $pro = $this->dbConnect->query("select * from projects");
        return $pro->fetchAll(PDO::FETCH_OBJ);
    }
    public function getTasks($id){
        $data = $this->dbConnect->query("select * from tasks where project_id = '$id' and delete_at is null");
        return $data->fetchAll(PDO::FETCH_OBJ);
    }
    public function taskView($id){
        $data = $this->dbConnect->query("SELECT * FROM tasks WHERE id = '$id'");
        return $data->fetchAll(PDO::FETCH_OBJ);
    }
    public function insertTask($nam,$des,$img,$id){
        $this->dbConnect->query("INSERT INTO tasks (task_name,task_description,task_image,project_id) VALUES ('$nam','$des','$img','$id')");
    }
    public function undeleted($id){
        $undeletedTasks = $this->dbConnect->query("SELECT * FROM tasks WHERE project_id = '$id' AND delete_at IS NULL");
        return $undeletedTasks->fetchAll(PDO::FETCH_OBJ);
    }
    public function deleteTask($id){
        $deletedTasks = $this->dbConnect->query("SELECT * FROM tasks WHERE project_id = '$id' AND delete_at IS NOT NULL");
        return $deletedTasks->fetchAll(PDO::FETCH_OBJ);
    }

    public function delete($id){
        $this->dbConnect->query("UPDATE tasks SET delete_at = now() WHERE id = '$id'");
    }
    public function count($id){
        $deleteCount = $this->dbConnect->query("SELECT count(id) from tasks where project_id = '$id' and delete_at is null");
        return $deleteCount->fetch(PDO::FETCH_NUM);
    }
    public function deletedCount($id){
        $deleteCount = $this->dbConnect->query("SELECT count(id) from tasks where project_id = '$id' and delete_at is not null");
        return $deleteCount->fetch(PDO::FETCH_NUM);
    }

    public function insertProImg($imgs,$id){
        $this->dbConnect->query("INSERT INTO images (images_path,module_name,module_id) VALUES ('$imgs','project',19)");

    }
}