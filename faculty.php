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
                <li class="nav-item mx-2">
                    <a class="nav-link" href="AdminHome.php">Home</a>
                </li>
                <li class="nav-item active mx-2">
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
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3 class="m-2 py-2">List of Faculty Members</h3>
                <?php $results = mysqli_query($db, "SELECT * FROM users WHERE type = 'Faculty'"); ?>

                <table class="table table-hover my-3">
                    <thead>
                        <tr class="table-primary">
                            <th>ID Number</th>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                            <tr class="table-default">
                                <td><?php echo $row['id_num']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
    require './includes/footer.php'
?>