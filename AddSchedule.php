<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Add Schedule</title>
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
        <div class="row ">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 p-5 my-5 bg-primary border-radius-2 rounded">
                <h2 class="p-2 mb-4 text-center text-white">Add Schedule</h2>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label class="text-white">Day:</label>
                        <select class="form-control" name="day">
                            <option>Monday</option>
                            <option>Tuesday</option>
                            <option>Wednesday</option>
                            <option>Thursday</option>
                            <option>Friday</option>
                            <option>Saturday</option>
                        </select>
                        <span class="error text-danger"><?php echo $dayErr; ?></span>
                    </div>
                    <div class="form-group my-3">
                        <label class="text-white">Start Time:</label>
                        <input type="time" class="form-control" name="start_time" placeholder="" value="">
                        <span class="error text-danger"><?php echo $startErr; ?></span>
                    </div>
                    <div class="form-group my-3">
                        <label class="text-white">End Time:</label>
                        <input type="time" class="form-control" name="end_time" placeholder="">
                        <span class="error text-danger"><?php echo $endErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label class="text-white">Assign Instructor:</label>
                        <?php $result = mysqli_query($db, "SELECT * from users WHERE type = 'Faculty'"); ?>
                        <select class="form-control" name="instructor">
                        <?php while($row = mysqli_fetch_array($result)) { ?>
                            <option value = <?php echo $row['id'];?>><?php echo $row['name'];?></option>
                        <?php } ?>
                        </select>
                        <span class="error text-danger"><?php echo $instErr; ?></span>
                    </div>
                    <div class="md-form">
                        <div class="d-flex bd-highlight justify-content-center">
                            <div class=" bd-highlight mt-3">
                                <input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="add_sched">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <span class="error text-danger my-3"><?php echo $conflictErr; ?></span> 
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require './includes/footer.php'
    ?>