<?php

class connection{
    public $dbConnect;
    public function __construct()
    {
        $this->dbConnect = new PDO('mysql:host=localhost;dbname=projectNewManagement','root','jeeva143');
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
        $output = [];
        $data = $this->dbConnect->query("SELECT * FROM tasks WHERE id = '$id'")->fetchAll(PDO::FETCH_OBJ);
        $images = $this->dbConnect->query("SELECT img_path FROM images WHERE model_no = '$id' and model_name = 2")->fetchAll(PDO::FETCH_OBJ);
        array_push($output,$data,$images);
        return $output;
    }
    public function insertTask($nam,$des,$id){
        $this->dbConnect->query("INSERT INTO tasks (task_name,task_description,project_id) VALUES ('$nam','$des','$id')");
        $dataNu = $this->dbConnect->query("SELECT id FROM tasks order by id desc limit 1")->fetch(PDO::FETCH_NUM);
        return $dataNu[0];
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

    public function insertProImg($imgs,$id,$type){
        $this->dbConnect->query("INSERT INTO images (img_path,model_name,model_no,created_at,updated_at) VALUES ('$imgs','$type',$id,now(),now())");
    }
}