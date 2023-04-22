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
        <div class="row mt-5">
            <div class="col-sm-6">
            <?php $name =  $_SESSION['user']['name']; ?>
            <?php $stud_id =  $_SESSION['user']['id_num'];?>
                <h3 class="text-left py-3">Welcome, <?php echo $name;?>
                </h3>
            </div>
        </div>
            <?php $results = mysqli_query($db, "SELECT * FROM subjects"); ?>
                <h4 class="mt-3">List of Offered Courses: </h4>
                <table class="table table-hover my-3">
                    <thead>
                        <tr class="table-primary">
                            <th>Course Code</th>
                            <th>Course Name</th>
                            <th class="text-center">Units</th>
                            <th class="text-center">Maximum Capacity</th>
                            <th class="text-center">Schedules</th>  
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
                                <td class="text-center">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                        <input type="hidden" name="row_id" value="<?php echo $subject_id; ?>">
                                        <input type="hidden" name="stud_id" value="<?php echo $stud_id ?>">
                                        <button type="submit" class="btn btn-info btn-sm text-white m-1 py-2 px-3" name="view_sched_stud">View</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
    </div>
        
    </div>

    <?php
    require './includes/footer.php'
    ?>