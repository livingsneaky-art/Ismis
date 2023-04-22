<?php
 require './includes/server.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <script src="script.js"></script>
    <title>My Schedule</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h5 class="navbar-brand font-weight-bold m-1 px-2 mr-3">ISMIS 2.0   </h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-exp" aria-controls="navbar-exp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-exp">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="IndexStudent.php">Home</a>
                </li>
                <li class="nav-item active mx-2">
                    <?php if($_SESSION['user']['type'] == "Student"): ?>
                        <a class="nav-link" href="MySchedule.php?view_sched=<?php echo $_SESSION['user']['id_num']; ?>">My Schedule</a>
                    <?php endif ?>
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
            <div class="col-sm-6">
            </div>
        </div>
            <?php $stud_id = $_SESSION['mysched']['stud_id']; ?>
            <?php $results = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $stud_id "); ?>
            <?php if (mysqli_num_rows($results) == 0) : ?>
                <h4 class="text-center text-danger p-4 m-4">NO SCHEDULES SET!</h4>
            <?php endif ?>
            <?php if (mysqli_num_rows($results) > 0) : ?>
                <h3 class="my-2 py-2">Your Schedule</h3>
                <table class="table table-hover my-3">
                    <thead>
                        <tr class="table-primary">
                            <th>Course Code</th>
                            <th colspan = "2" class="text-center">Schedule</th>
                            <th>Course Description</th>
                            <th class="m-0 px-0">Units</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr class="table-default">
                                <?php $sched_id = $row['sched_id']; ?>
                                <?php $enrollee_id = $row['id']; ?>
                                <?php $inst_result = mysqli_query($db, "SELECT * FROM schedules WHERE id = $sched_id"); ?>
                                <?php while ($row1 = mysqli_fetch_array($inst_result)) { ?>
                                    <?php $course_id = $row1['course_id']; ?>
                                    <?php $inst_result1 = mysqli_query($db, "SELECT * FROM subjects WHERE id = $course_id"); ?>
                                    <?php while ($row2 = mysqli_fetch_array($inst_result1)) { ?>
                                        <td class="py-4"><?php echo $row2['course_code'] ?></td>
                                        <td class="text-right py-4"><?php echo $row1['day'] ?></td>
                                        <td class="py-4"><?php echo $row1['time_start'] . " - " . $row1['time_end'] ?></td>
                                        <td class="py-4"><?php echo $row2['course_name'] ?></td>
                                        <td class="py-4 m-0 pl-3"><?php echo $row2['units'] ?></td>
                                        <td class="text-center m-0 px-0">
                                            <a class="btn btn-danger btn-sm text-white m-1 py-2 px-3" href="MySchedule.php?del_sched_student=<?php echo $enrollee_id ?>">Delete</a>
                                        </td>
                                </tr>
                              <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
    </div>

    <?php
    require './includes/footer.php'
    ?>