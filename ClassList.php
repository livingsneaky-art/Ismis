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
    <title>Class List</title>
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
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3>List of Students</h3>
                    <?php $id = $_SESSION['sched']['sched_id']; ?>
                    <?php $results = mysqli_query($db, "SELECT * FROM enrollees WHERE sched_id = $id"); ?>
                    <?php if (mysqli_num_rows($results) == 0) : ?>
                        <h4 class="text-center text-danger p-4 m-4">NO STUDENTS ENROLLED IN THIS SCHEDULE!</h4>
                    <?php endif ?>
                    <?php if (mysqli_num_rows($results) > 0) : ?>
                                <table class="table table-hover my-3">
                                <thead>
                                    <tr class="table-primary">
                                        <th>ID Number</th>
                                        <th>Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <?php $stud_id = $row['stud_id']; ?>
                                        <?php $results1 = mysqli_query($db, "SELECT * FROM users WHERE id_num = $stud_id"); ?>
                                        <?php while ($row1 = mysqli_fetch_array($results1)) { ?>
                                        <tr class="table-default">
                                            <td><?php echo $row1['id_num']; ?></td>
                                            <td><?php echo $row1['name']; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <?php } ?>
                                </tbody>
                            </table>
                    <?php endif ?>
            </div>
        </div>
    </div>

    <?php
    require './includes/footer.php'
    ?>