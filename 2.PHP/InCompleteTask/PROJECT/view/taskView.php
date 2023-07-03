<html>
<head>
    <title>Task View</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body{
            background-color: gainsboro;
        }
        img{
            height: 100px;
            width: 100px    ;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php foreach ($data as $datas=>$value): ?>
        <div class="card text-center">
            <div class="card-header">
                Featured
            </div>
            <div class="card-body">
                <img src="<?php echo $value->task_image?>" class="img-thumbnail" alt="...">
                <h5 class="card-title"><?php echo $value->task_name?></h5>
                <p class="card-text"><?php echo $value->task_description ?></p>
                <form action="/delete" method="post">
                    <button type="submit" value="<?php echo $value->id ?>" name="id">Delete</button>
                </form>
                <form action="/" method="post">
                    <button type="submit" class="btn btn-success">Home</button>
                </form>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>