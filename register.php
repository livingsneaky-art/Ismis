<?php
require './includes/server.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./includes/styles/bootstrap.min.css">
    <title>Register</title>
</head>

<body class="bg-secondary">
    <div class="container">
        <div class="row my-4">
            <div class="col-sm-3"></div>
            <div class="col-sm-6 p-5 my-3 bg-primary border-radius-3 rounded">
                <h2 class="p-2 mb-4 text-center text-white">Registration</h2>
                <div class ="card-body">
                <form method="POST" action="" class="form">
                    <div class="form-group">
                            <label class="text-white">Complete Name:</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter your complete name" value="<?php if(isset($name) && $uniqueCheck != false){ echo $name; }?>">
                            <span class="error text-danger"><?php echo $nameErr ?></span>
                    </div>
                    <div class="form-group ">
                            <label class="text-white">ID Number:</label>
                            <input type="text" class="form-control" name="id_num" placeholder="Enter your ID number" value="<?php if(isset($id_num) && $uniqueCheck != false){ echo $id_num; }?>">
                            <span class="error text-danger"><?php echo $idErr ?></span>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-sm-6">
                            <label class="mt-2 text-white">I am a:</label>
                            <div class="row ml-5">
                                <div class="col-sm-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="student_radio" name="type" class="custom-control-input"
                                            value="Student">
                                        <label class="custom-control-label text-white" for="student_radio">Student</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="faculty_radio" name="type" class="custom-control-input"
                                            value="Faculty">
                                        <label class="custom-control-label text-white" for="faculty_radio">Faculty</label>
                                    </div>
                                </div>
                            </div>
                            <span class="error text-danger"><?php echo $typeErr ?></span>
                        </div>
                    </div>
                    <div class="form-group row my-3">
                        <div class="col-sm-6">
                            <label class="text-white">Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password">
                            <span class="error text-danger"><?php echo $passErr; ?></span>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-white">Confirm Password:</label>
                            <input type="password" class="form-control" name="con_password" placeholder="Confirm password">
                            <span class="error text-danger"><?php echo $conErr; ?></span>
                        </div>
                    </div>
                    <div class="md-form">
                        <div class="d-flex bd-highlight m-2 justify-content-center">
                            <div class=" mt-3 bd-highlight">
                                <input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="register_btn">
                            </div>
                        </div>
                    </div>
                </form>
                </div>
                <div class="error text-center mb-3">
                    <span class="error text-danger"><?php echo $uniqueErr; ?></span>
                </div>
                <div class="text-center p-2">
                    <a  class="text-secondary" href="login.php">Already have an account? Log in here</a>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>

</html>