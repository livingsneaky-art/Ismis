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
    <title>Home</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h5 class="navbar-brand font-weight-bold m-1 px-2 mr-3">ISMIS 2.0   </h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-exp" aria-controls="navbar-exp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-exp">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active mx-2">
                    <a class="nav-link" href="IndexFaculty.php">Home</a>
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
                <h3 class="text-left py-3">Welcome, <?php echo $_SESSION['user']['name'];
                 $user_id = $_SESSION['user']['id'];?>
                </h3>
            </div>
        </div>
            <?php $results = mysqli_query($db, "SELECT * FROM schedules WHERE faculty_id = $user_id "); ?>
            <?php if (mysqli_num_rows($results) == 0) : ?>
                <h4 class="text-center text-danger p-4 m-4">NO ASSIGNED SCHEDULE!</h4>
            <?php endif ?>
            <?php if (mysqli_num_rows($results) > 0) : ?>
                <h4 class="mt-3">Your Schedule</h4>
                <table class="table table-hover my-3">
                    <thead>
                        <tr class="table-primary">
                            <th>Course Code</th>
                            <th colspan = "2" class="text-center">Schedule</th>
                            <th>Course Name</th>
                            <th>Units</th>
                            <th>Maximum Capacity</th>
                            <th>Current Population</th>
                            <th class="text-center">Enrollees</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr class="table-default">
                                <?php $sched_id = $row['id']; ?>
                                <?php $stud_id = $row['stud_id']; ?>
                                <?php $course_id = $row['course_id']; ?>
                                <?php $inst_result = mysqli_query($db, "SELECT * FROM subjects WHERE id = $course_id"); ?>
                                <?php while ($row1 = mysqli_fetch_array($inst_result)) { ?>
                                    <td class="py-4"><?php echo $row1['course_code'] ?></td>
                                    <td class="text-right py-4"><?php echo $row['day'] ?></td>
                                    <td class="py-4"><?php echo $row['time_start'] . "  -  " . $row['time_end']?></td>
                                    <td class="py-4"><?php echo $row1['course_name'] ?></td>
                                    <td class="text-center py-4"><?php echo $row1['units'] ?></td>
                                    <td class="text-center py-4"><?php echo $row1['max'] ?></td>
                                    <td class="text-center py-4"><?php echo $row['enrollees'] ?></td>
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="row_id" value="<?php echo $sched_id; ?>">
                                <td class="text-center m-0 px-0">
                                    <button type="submit" class="btn btn-success btn-sm text-white my-1 mx-2 py-2 px-3" name="view_students">View</button>
                                </td>
                                </form>
                            </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            <?php endif ?>
    </div>
        
    </div>

    <?php
    require './includes/footer.php'
    ?>