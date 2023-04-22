<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Edit Course</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h5 class="navbar-brand font-weight-bold m-1 pr-4">ISMIS 2.0</h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-exp" aria-controls="navbar-exp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-exp">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="AdminHome.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="Faculty.php">Faculty</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="Students.php">Students</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <button type="submit" class="btn btn-primary text-white mx-2" name="logout">Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row mt-4">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 p-4 my-5 bg-primary border-radius-2 rounded">
                <h2 class="p-2 mb-4 text-center text-white">Edit Course</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group my-3">
                        <input type="hidden" name= "subject_id" value = "<?php echo $_SESSION['course']['id']; ?>">
                        <label class="text-white">Course Code:</label>
                        <input type="text" class="form-control" name="course_code" placeholder="Enter course code" value="<?php echo $_SESSION['course']['course_code']; ?>">
                        <span class="error text-danger"><?php echo $codeErr; ?></span>
                    </div>
                    <div class="form-group my-3">
                        <label class="text-white">Course Name:</label>
                        <input type="text" class="form-control" name="course_name" placeholder="Enter course name" value="<?php echo $_SESSION['course']['course_name']; ?>">
                        <span class="error text-danger"><?php echo $courseNameErr; ?></span>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-sm-6">
                            <label class="text-white">Maximum Number of Enrollees:</label>
                            <input type="number" class="form-control" name="max" placeholder="Set the maximum capacity" value="<?php echo $_SESSION['course']['max']; ?>">
                            <span class="error text-danger"><?php echo $maxErr; ?></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-white">Number of Units:</label>
                            <input type="number" class="form-control" name="units" placeholder="Set the number of units" value="<?php echo $_SESSION['course']['units']?>">
                            <span class="error text-danger"><?php echo $unitsErr; ?></span>
                        </div>
                    </div>
                    <div class="md-form">
                        <div class="d-flex bd-highlight justify-content-center mt-5">
                            <div class="bd-highlight">
                                <input type="submit" value="Save" class="btn btn-success btn-lg text-white" name="save">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require './includes/footer.php'
    ?>