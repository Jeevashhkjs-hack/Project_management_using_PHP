<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body{
            background-color: gainsboro;
        }
        button.btn.btn-primary {
            margin-top: 40px;
        }
        .proTask{
            display: flex;
        }
        button{
            background-color: transparent;
        }
        img{
            height: 100px;
            width: 100px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if($_SESSION['projectPage']): ?>
            <?php require 'view/createTask.php'?>
        <?php else: ?>
            <div class="addNewPro">
                <form action="/createProject" method="post">
                    <button type="submit" class="btn btn-primary">Add new Project</button>
                </form>
                <div class="proTask">
                    <div class="projects">
                        <table class="table table-success table-striped-columns">
                            <thead>
                            <th>S.No</th>
                            <th>Projects</th>
                            </thead>
                            <tbody>
                            <?php foreach($projects as $data=>$value): ?>
                                <tr>
                                    <td><?php echo $value->id ?></td>
                                    <form action="/getTasks" method="post">
                                        <td><button type="submit" value="<?php echo $value->id ?>" name="tarId"><?php echo $value->project_name ?></button></td>
                                    </form>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <ul>
                            <?php if($_SESSION['projectId']): ?>
                                <form action="/addTask" method="post">
                                    <button type="submit">Add Task</button>
                                </form>
                                <form action="/undeletedTask" method="post">
                                    <button>Undelete Task(<?php echo $undeleteCn[0] ?>)</button>
                                </form>
                                <form action="/deletedTask" method="post">
                                    <button type="submit" value="<?php echo $_SESSION['projectId'] ?>" name="id">Deleted Task(<?php echo $deleCnt[0] ?>)</button>
                                </form>
                            <?php endif; ?>
                            <?php foreach($datas as $data=>$getValue): ?>
                                <form action="/taskView" method="post">
                                    <button type="submit" name="tarId" value="<?php echo $getValue->id ?>">
                                        <div class="card" style="width: 18rem;">
                                            <img src="<?php echo $getValue->task_image ?>" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text"><?php echo $getValue->task_name ?></p>
                                            </div>
                                        </div>
                                    </button>
                                </form>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<script  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>