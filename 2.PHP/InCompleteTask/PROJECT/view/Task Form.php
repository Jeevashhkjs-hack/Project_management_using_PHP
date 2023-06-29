<html>
<head>
    <title>Task Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <form action="/addTask" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Task Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="taskName" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Task Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="taskDes"></textarea>
            </div>
            <div class="input-group mb-3">
                <input type="file" class="form-control" id="inputGroupFile02" name="userImg">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <button type="submit" class="btn btn-secondary">Add Task</button>
        </form>
    </div>
</body>
</html>