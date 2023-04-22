<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Enroll Student</title>
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
        <div class="row my-4">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 p-5 my-5 bg-primary border-radius-2 rounded">
                <h2 class="p-2 mb-4 text-center text-white">Enroll Student</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="px-4">
                    <div class="form-group row">
                        <input type="hidden" name = "sched_id" value = "<?php echo $_SESSION['sched']['id']; ?>">
                        <input type="hidden" name = "course_id" value = "<?php echo $_SESSION['sched']['course_id']; ?>">
                    </div>
                    <div class="form-group row">
                        <label class="text-white">Student ID Number:</label>
                        <input type="text" class="form-control" name="stud_id" placeholder="Enter the ID number" >
                        <span class="error text-danger"><?php echo $IDErr; ?></span>
                        </div>
                        <div class="md-form">
                            <div class="d-flex bd-highlight mb-3 justify-content-center">
                                <div class="p-2 mt-3 bd-highlight">
                                    <input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="add_student">
                                </div>
                            </div>
                            <span class="error text-danger my-3"><?php echo $conflictErr; ?></span> 
                        </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require './includes/footer.php'
    ?>