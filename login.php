
<?php
require './includes/server.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Login</title>
</head>
<body class="bg-secondary">
<div class="container">
        <div class="row my-5">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 p-5 my-5 bg-primary border-radius-2 rounded">
                <h2 class="p-2 mb-4 text-center text-white">Login</h2>
                <form method="POST" action="">
                    <div class="form-group my-3">
                        <label class="text-white">ID Number:</label>
                        <input type="text" class="form-control" name="id_num" placeholder="Enter your ID number" 
                        value="<?php if(isset($login_id_num) && $existCheck != false){ echo $login_id_num; }?>">
                            <span class="error text-danger"><?php echo $logIdErr; ?></span>
                    </div>
                    <div class="form-group my-3">
                        <label class="text-white">Password:</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter password">
                        <span class="error text-danger"><?php echo $logPassErr; ?></span>
                    </div>
                    <div class="md-form">
                        <div class="d-flex bd-highlight mt-2 justify-content-center">
                            <div class="p-3 m-2 bd-highlight">
                                <input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="login_btn">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="error text-center mb-3">
                    <span class="error text-danger"><?php echo $existErr; ?></span>
                </div>
                <div class="text-center pt-2">
                    <a class="text-secondary" href="register.php">No account? Register here</a>
                </div>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</body>
</html>