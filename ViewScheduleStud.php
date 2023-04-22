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
    <title>View Schedules</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <h5 class="navbar-brand font-weight-bold m-1 px-2 mr-3">ISMIS 2.0</h5>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-exp" aria-controls="navbar-exp" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-exp">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="IndexStudent.php">Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="MySchedule.php?view_sched=<?php echo $_SESSION['user']['id_num']; ?>">My Schedule</a>
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
        <?php $subject_id = $_SESSION['course']['id'];
        $stud_id = $_SESSION['user']['id_num']; ?>
        <h3 class="mt-5 py-2">List of Schedules for <?php echo $_SESSION['course']['course_code'] . " - " . $_SESSION['course']['course_name']; ?>
        </h3>
        <?php $results = mysqli_query($db, "SELECT * FROM schedules WHERE course_id = $subject_id "); ?>
        <?php if (mysqli_num_rows($results) == 0) : ?>
            <h4 class="text-center text-danger p-4 m-4">NO SCHEDULES SET!</h4>
        <?php endif ?>
        <?php if (mysqli_num_rows($results) > 0) : ?>
            <h5 class="error text-danger font-weight-bold float-right mb-3 p-2"><?php echo $conflictErr; ?></h5>
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>Day</th>
                        <th class="text-center">Time</th>
                        <th>Instructor</th>
                        <th class="m-0 px-0">Enrollees</th>
                        <th class="text-center">Enroll</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                        <tr class="table-default">
                            <td class="py-4"><?php echo $row['day'] ?></td>
                            <td class="text-center py-4"><?php echo $row['time_start'] . " - " . $row['time_end'] ?></td>
                            <?php $faculty_id = $row['faculty_id']; ?>
                            <?php $inst_result = mysqli_query($db, "SELECT * FROM users WHERE id = $faculty_id"); ?>
                            <?php $instructor = mysqli_fetch_assoc($inst_result); ?>
                            <td class="py-4">
                                <?php echo $instructor['name']; ?>
                            </td>
                            <td class="py-4 m-0 px-0 pl-4"><?php echo $row['enrollees'] ?></td>
                            <td class="text-center m-0 px-0">
                                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <input type="hidden" name="sched_id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="stud_id" value="<?php echo $stud_id; ?>">
                                    <button type="submit" class="btn btn-success btn-sm text-white my-1 mx-2 py-2 px-3" name="enroll_student_side">Enroll</button>
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