<html>
<head>
    <title>Create Task</title>
</head>
<body>
    <div class="container">
        <form action="/createProject" method="post"  enctype="multipart/form-data">
                <label for="exampleInputEmail1" class="form-label">Project Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="projectName">
                <input type="file" class="form-control" id="inputGroupFile02" multiple="multiple" name="proImg[]">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>