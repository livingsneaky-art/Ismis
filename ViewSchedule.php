<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>View Schedules</title>
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
        <div class="row mt-5">
            <div class="col-sm-10">
                <h3 class="m-2 py-2">List of Schedules for <?php echo $_SESSION['course']['course_code'] . " - " . $_SESSION['course']['course_name']; 
                    $subject_id = $_SESSION['course']['id'] ?></h3>
            </div>
            <div class="col-sm-2 mt-1 pt-1">
                <a class="nav-link btn btn-success m-2 p-2 float-right" href="AddSchedule.php">Add Schedule</a>
            </div>
        </div>
        <?php $results = mysqli_query($db, "SELECT * FROM schedules WHERE course_id = $subject_id "); ?>
        <?php if (mysqli_num_rows($results) == 0) : ?>
            <h4 class="text-center text-danger p-4 m-4">NO SCHEDULES SET!</h4>
        <?php endif ?>
        <?php if (mysqli_num_rows($results) > 0) : ?>
            <table class="table table-hover my-3">
                <thead>
                    <tr class="table-primary">
                        <th>Day</th>
                        <th>Time Start</th>
                        <th>Time End</th>
                        <th class="text-center">Instructor</th>
                        <th class="text-center">Instructor Actions</th>
                        <th class="text-center">Enrollees</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr class="table-default">
                            <td class="py-4"><?php echo $row['day'] ?></td>
                            <td class="py-4"><?php echo $row['time_start'] ?></td>
                            <td class="py-4"><?php echo $row['time_end'] ?></td>

                            <?php $faculty_id = $row['faculty_id']; ?>
                            <?php $inst_result = mysqli_query($db, "SELECT * FROM users WHERE id = $faculty_id"); ?>
                            <?php $instructor = mysqli_fetch_assoc($inst_result); ?>
                            <td class="text-center py-4">
                                <?php echo $instructor['name']; ?>
                            </td>
                            <td class="text-center m-0 px-0">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="row_id" value="<?php echo $row['id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-secondary my-1 py-2 " name="remove_instructor">Remove</button>
                            </td>
                            <td class="text-center m-0 px-0">
                                <button type="submit" class="btn btn-success btn-sm text-white my-1 mx-2 py-2 px-3" name="enroll_stud">Enroll</button>
                            </td>
                            <td class="text-center m-0 px-0">
                                <button type="submit" class="btn btn-warning btn-sm text-white my-1 mx-2 py-2 px-3" name="edit_sched">Edit</button>
                                <button type="submit" class="btn btn-danger btn-sm text-white my-1 mx-2 py-2 px-3" name="del_sched">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php endif ?>
    </div>

    <?php
    require './includes/footer.php'
    ?>