<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Admin</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h5 class="navbar-brand font-weight-bold m-1 pr-4">ISMIS 2.0</h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-exp" aria-controls="navbar-exp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-exp">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active mx-2">
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
                <h3 class="m-2 py-2">List of Courses</h3>
            </div>
            <div class="col-sm-2">
                <a class="nav-link btn btn-success m-2 p-2 float-right" href="AddCourse.php">Add Course</a>
            </div>
        </div>

        <?php $results = mysqli_query($db, "SELECT * FROM subjects"); ?>
        <?php if (mysqli_num_rows($results) == 0) : ?>
            <h4 class="text-center text-danger p-4 m-4">NO COURSES ENROLLED!</h4>
        <?php endif ?>
        <?php if (mysqli_num_rows($results) > 0) : ?>
            <table class="table table-hover my-3">
                <thead>
                    <tr class="table-primary">
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Units</th>
                        <th>Maximum Capacity</th>
                        <th>Enrollees</th>
                        <th class="text-center">Schedules</th>
                        <th colspan="3" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <?php $subject_id = $row['id'];?>
                        <tr class="table-default">
                            <td class="py-4"><?php echo $row['course_code']; ?></td>
                            <td class="py-4"><?php echo $row['course_name']; ?></td>
                            <td class="text-center py-4"><?php echo $row['units']; ?></td>
                            <td class="text-center py-4"><?php echo $row['max']; ?></td>
                            <?php $results_total = mysqli_query($db, "SELECT * FROM schedules WHERE course_id = $subject_id"); ?>
                            <?php $row2 = mysqli_fetch_assoc($results_total) ?>
                                <?php if(mysqli_num_rows($results_total) > 0) : ?>
                                    <td class="text-center py-4"><?php echo $row2['enrollees'] ?></td>
                                <?php endif ?>
                                <?php if (mysqli_num_rows($results_total) == 0) : ?>
                                    <td class="text-center py-4">0</td>
                                <?php endif ?>
                            <td class="text-center">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="row_id" value="<?php echo $subject_id; ?>">
                                    <button type="submit" class="btn btn-info btn-sm text-white m-1 py-2 px-3" name="view_sched">View</button>
                            </td>
                            <td class="text-center m-0 px-0">
                                <button type="submit" class="btn btn-warning btn-sm text-white m-1 py-2 px-3" name="edit_course">Edit</button>
                                
                            </td>
                            <td class="text-center m-0 px-0">
                                <button type="submit" class="btn btn-danger btn-sm text-white m-1 py-2 px-3" name="del_course">Delete</button>
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