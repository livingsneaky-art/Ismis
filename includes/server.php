<?php
ini_set("display_errors", 0);
session_start();
$db = mysqli_connect('localhost', 'root', '', 'ismis_db');

if (isset($_POST["logout"])) {
    unset($_SESSION);
    session_destroy();
    header("Location: login.php");
}

// LOGIN
$logErr = 0;
$existCheck = true;
$logIdErr = $logPassErr = $existErr = "";
$admin_id = "admin";
$admin_password = "admin";

if (isset($_POST['login_btn'])) {
    $login_id_num = mysqli_real_escape_string($db, $_POST['id_num']);
    $login_password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($login_id_num)) {
        $logIdErr = "ID Number is required.";
        $logErr++;
    }
    if (empty($login_password)) {
        $logPassErr = "Password is required.";
        $logErr++;
    }

    if ($logErr == 0) {
        if ($login_id_num == $admin_id && $login_password == $admin_password) {
            header('location: AdminHome.php');
        } else {
            $login_password = md5($login_password);
            $query = "SELECT * FROM users WHERE id_num = '$login_id_num'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 0) {
                $existErr = "Account does not exist.";
                $existCheck = false;
            } else {
                $query = "SELECT * FROM users WHERE id_num = '$login_id_num' AND password = '$login_password'";
                $results = mysqli_query($db, $query);
                if (mysqli_num_rows($results) == 1) {
                    $_SESSION['user'] = mysqli_fetch_assoc($results);
                    if($_SESSION['user']['type']== 'Faculty'){
                        header('location: IndexFaculty.php');
                    }else if($_SESSION['user']['type']== 'Student'){
                        header('location: IndexStudent.php');
                    }
                } else {
                    $existErr = "Wrong password.";
                }
            }
        }
    }
}
// LOGIN END

// REGISTRATION
$regErr = 0;
$uniqueCheck = true;
$nameErr = $idErr = $passErr = $conErr = $typeErr = $uniqueErr = "";

if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $id_num = mysqli_real_escape_string($db, $_POST['id_num']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $con_password = mysqli_real_escape_string($db, $_POST['con_password']);
    $type = mysqli_real_escape_string($db, $_POST['type']);

    if (empty($name)) {
        $nameErr = "Name is required.";
        $regErr++;
    }
    if (empty($type)) {
        $typeErr = "User type is required.";
        $regErr++;
    }
    if (empty($id_num)) {
        $idErr = "ID Number is required";
        $regErr++;
    }
    if (empty($password)) {
        $passErr = "Password is required";
        $regErr++;
    }
    if ($password != $con_password) {
        $conErr = "Passwords do not match";
        $regErr++;
    }

    $user_check_query = "SELECT * FROM users WHERE id_num = '$id_num' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['id_num'] === $id_num) {
            $uniqueErr = "User account already exists!";
            $uniqueCheck = false;
            $regErr++;
        }
    }
    if ($regErr == 0) {
        $password = md5($password);
        $query = "INSERT INTO users (id_num,name,password,type) 
                VALUES('$id_num','$name','$password','$type')";
        mysqli_query($db, $query);
        header('Location: login.php');
    }
}
// REGISTRATION END

// ADMIN
$enrollees = 0;

// Add Course
$courseErrors = 0;
$courseCheck = true;
$codeErr = $courseNameErr = $maxErr = $unitsErr = $courseErr = "";

if (isset($_POST['add_course'])) {
    $course_code = mysqli_real_escape_string($db, $_POST['course_code']);
    $course_name = mysqli_real_escape_string($db, $_POST['course_name']);
    $max = mysqli_real_escape_string($db, $_POST['max']);
    $units = mysqli_real_escape_string($db, $_POST['units']);

    if (empty($course_code)) {
        $codeErr = "Course Code is required.";
        $courseErrors++;
    }
    if (empty($course_name)) {
        $courseNameErr = "Course Name is required.";
        $courseErrors++;
    }
    if (empty($max)) {
        $maxErr = "Maximum Capacity is required.";
        $courseErrors++;
    }
    if (empty($units)) {
        $unitsErr = "Number of Units is required.";
        $courseErrors++;
    }

    $course_check_query = "SELECT * FROM subjects WHERE course_code='$course_code' LIMIT 1";
    $result = mysqli_query($db, $course_check_query);
    if (mysqli_num_rows($result) != 0) {
        $courseErr = "Course already exists";
        $courseCheck = false;
        $courseErrors++;
    } else if ($courseErrors == 0) {
        $query = "INSERT INTO subjects (course_code,course_name,units,max) 
        VALUES('$course_code', '$course_name', $units, $max)";
        mysqli_query($db, $query);
        header('Location: AdminHome.php');
    }
}

// Delete Course
if (isset($_POST['del_course'])) {
    $row_id = $_POST['row_id'];
    mysqli_query($db, "DELETE FROM subjects WHERE id = $row_id");
    $query = mysqli_query($db, "SELECT * FROM schedules WHERE course_id = $row_id");
    if (mysqli_num_rows($query) != 0) {
        $_SESSION['sched'] = mysqli_fetch_assoc($query);
        $course_id = $_SESSION['sched']['course_id'];
        $sched_id = $_SESSION['sched']['id'];
        mysqli_query($db, "DELETE FROM schedules WHERE course_id = $course_id");
        mysqli_query($db, "DELETE FROM enrollees WHERE sched_id = $sched_id");
    }

    header('location: AdminHome.php');
}

//Edit Course
if (isset($_POST['edit_course'])) {
    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM subjects WHERE id = '$row_id'";
    $result = mysqli_query($db, $query);
    $_SESSION['course'] = mysqli_fetch_assoc($result);
    header('location: EditCourse.php');
}

if (isset($_POST['save'])) {
    $course_id = $_POST['subject_id'];
    $course_code = $_POST['course_code'];
    $course_name = $_POST['course_name'];
    $max = $_POST['max'];
    $units = $_POST['units'];

    if (empty($course_code)) {
        $codeErr = "Course Code is required.";
        $courseErrors++;
    }
    if (empty($course_name)) {
        $courseNameErr = "Course Name is required.";
        $courseErrors++;
    }
    if (empty($max)) {
        $maxErr = "Maximum Capacity is required.";
        $courseErrors++;
    }
    if (empty($units)) {
        $unitsErr = "Number of Units is required.";
        $courseErrors++;
    }

    if ($courseErrors == 0) {
        $sql = "UPDATE subjects SET course_code = '$course_code', course_name = '$course_name', max = '$max', units = '$units' WHERE id = '$course_id'";
        $result = mysqli_query($db, $sql);
        if (!$result) {
            echo "Error updating" . mysqli_connect_error();
        } else {
            echo $sql;
            header("Location: AdminHome.php");
        }
    }
}

// View Schedule
if (isset($_POST['view_sched'])) {
    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM subjects WHERE id = $row_id";
    $result = mysqli_query($db, $query);
    $_SESSION['course'] = mysqli_fetch_assoc($result);
    header("Location: ViewSchedule.php");
}

// Add Schedule
$schedErrors = 0;
$dayErr = $startErr = $endErr = $instErr = $conflictErr = "";
$subject_id = $_SESSION['course']['id'];
$sched_id = $_SESSION['sched']['id'];

if (isset($_POST['add_sched'])) {
    $day = mysqli_real_escape_string($db, $_POST['day']);
    $start = mysqli_real_escape_string($db, $_POST['start_time']);
    $end = mysqli_real_escape_string($db, $_POST['end_time']);
    $instructor_id = mysqli_real_escape_string($db, $_POST['instructor']);

    if (empty($day)) {
        $dayErr = "Day is required.";
        $schedErrors++;
    }
    if (empty($start)) {
        $startErr = "Starting time is required.";
        $schedErrors++;
    }
    if (empty($end)) {
        $endErr = "Ending time is required.";
        $schedErrors++;
    }
    if (empty($instructor_id)) {
        $instErr = "Assigning an instructor is requierd.";
        $schedErrors++;
    }

    if ($schedErrors == 0) {
        $sched_check_query = "SELECT * FROM schedules WHERE day = '$day' AND faculty_id = '$instructor_id' AND ((time_start < '$end:00') AND (time_end > '$start:00'))";

        $sched_check_result = mysqli_query($db, $sched_check_query);
        if (mysqli_num_rows($sched_check_result) > 0) {
            $conflictErr = "There is a conflict for this schedule. Please enter another one.";
        } else {
            $query = "INSERT INTO schedules(day, time_start, time_end, faculty_id, course_id, enrollees) VALUES ('$day', '$start:00', '$end:00', '$instructor_id', '$subject_id', '$enrollees')";
            mysqli_query($db, $query);
            header('Location: ViewSchedule.php');
        }
    }
}


// Delete Schedule
if (isset($_POST['del_sched'])) {
    $row_id = $_POST['row_id'];
    mysqli_query($db, "DELETE FROM enrollees WHERE sched_id= $row_id");
    mysqli_query($db, "DELETE FROM schedules WHERE id= $row_id");
    
    header('location: ViewSchedule.php');
}

// Remove Instructor
if (isset($_POST['remove_instructor'])) {
    $row_id = $_POST['row_id'];
    mysqli_query($db, "UPDATE schedules SET faculty_id = '' WHERE id =$row_id");
    header('location: ViewSchedule.php');
}


//Edit Schedule
if (isset($_POST['edit_sched'])) {
    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM schedules WHERE id = $row_id";
    $result = mysqli_query($db, $query);
    $_SESSION['sched'] = mysqli_fetch_assoc($result);
    header('location: EditSchedule.php');
}

if (isset($_POST['save_sched'])) {
    $sched_id = $_POST['sched_id'];
    $day = $_POST['day'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $instructor_id = $_POST['instructor'];

    if (empty($day)) {
        $$dayErr = "Day is required.";
        $schedErrors++;
    }
    if (empty($start)) {
        $startErr = "Starting time is required.";
        $schedErrors++;
    }
    if (empty($end)) {
        $endErr = "Ending time is required.";
        $schedErrors++;
    }
    if (empty($instructor_id)) {
        $instErr = "Assigning an instructor is requierd.";
        $schedErrors++;
    }
    if ($schedErrors == 0) {
        // $sched_check_query = "SELECT * FROM schedules WHERE day = '$day' AND faculty_id = '$instructor_id' AND ((time_start <= '$start:00' AND time_end >= '$end:00') OR (time_start >= '$start:00' AND time_end <= '$end:00'))";
        $sched_check_query = "SELECT * FROM schedules WHERE day = '$day' AND faculty_id = '$instructor_id' AND ((time_start < '$end:00') AND (time_end > '$start:00'))";

        $sched_check_result = mysqli_query($db, $sched_check_query);
        if (mysqli_num_rows($sched_check_result) > 0) {
            echo $sched_check_query;
            $conflictErr = "There is a conflict for this schedule. Please enter another one.";
        } else {
            $sql = "UPDATE schedules SET day = '$day', time_start = '$start:00',time_end = '$end:00', faculty_id = '$instructor_id' WHERE id = '$sched_id'";
            $result = mysqli_query($db, $sql);
            if (!$result) {
                echo "Error updating" . mysqli_connect_error();
            } else {
                header("Location: ViewSchedule.php");
            }
        }
    }
}

//Remove Instructor
if (isset($_POST['del_sched'])) {
    $row_id = $_POST['row_id'];
    mysqli_query($db, "DELETE FROM schedules WHERE id= $row_id");
    mysqli_query($db, "DELETE FROM enrollees WHERE sched_id= $row_id");
    header('location: ViewSchedule.php');
}

if (isset($_POST['enroll_stud'])) {
    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM schedules WHERE id = $row_id";
    $result = mysqli_query($db, $query);
    $_SESSION['sched'] = mysqli_fetch_assoc($result);
    header('location: EnrollStudent.php');
}

//Enroll Student
$studErrors = 0;
$IDErr = $conflictErr = "";
$course_check = true;
$enrolled_arr = array();

if (isset($_POST['add_student'])) {
    $sched_id = $_POST['sched_id'];
    $course_id = $_POST['course_id'];
    $id_num = $_POST['stud_id'];

    if (empty($id_num)) {
        $IDErr = "Student ID Number is required.";
        $studErrors++;
    }

    $student_check_result = mysqli_query($db, "SELECT * FROM users WHERE id_num = $id_num");
    if (mysqli_num_rows($student_check_result) == 0 && (!empty($id_num))) {
        $conflictErr = "Student ID Number does not exist.";
        $studErrors++;
    } else
    if (mysqli_num_rows($student_check_result) > 0) {
        $enrolled_check_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num AND sched_id = $sched_id");
        if (mysqli_num_rows($enrolled_check_result) > 0) {
            $conflictErr = "Student is already enrolled in this schedule.";
            $studErrors++;
        } else {
            //get course student wants to enroll in
            $get_course = mysqli_query($db, "SELECT * FROM schedules WHERE id = $sched_id");
            $get_course_row = mysqli_fetch_assoc($get_course);
            $enroll_course_id = $get_course_row['course_id'];
            $enroll_enrollees = $get_course_row['enrollees'];
            $chosen_day = $get_course_row ['day'];
            $chosen_start = $get_course_row ['time_start'];
            $chosen_end = $get_course_row['time_end'];
            //get student's enrolled shcedules
            $course_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num");
            while($course_rows = mysqli_fetch_assoc($course_result)){
                $scheds = $course_rows['sched_id'];
                //check if student has an existing (diff) schedule with that course
                $check_course_result = mysqli_query($db, "SELECT * FROM schedules WHERE id = $scheds");
                $sched_row = mysqli_fetch_assoc($check_course_result);
                if($enroll_course_id === $sched_row['course_id']){
                    $course_check = false;
                }
            }
            if($course_check == false){
                $conflictErr = "Student is already enrolled in this course";
                $studErrors++;
            } else {
                //check for available slots
                $max_check_result = mysqli_query($db, "SELECT * FROM subjects WHERE id = $enroll_course_id");
                $max = mysqli_fetch_assoc($max_check_result);
                $num_max = $max['max'];
              //  get enrolled subjs of student from table:enrollees
                if($num_max < $enroll_enrollees +1){
                    $conflictErr = "Enrollment failed. Class is already full.";
                    $studErrors++;
                }
                $conflict_check_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num");
                while($row = mysqli_fetch_assoc($conflict_check_result)){
                    //INSERT IDS IN THE ARRAY HERE
                    array_push($enrolled_arr, $row['sched_id']); //get sched_ids of enrolled subjs
                }
                for($i = 0; $i < count($enrolled_arr) && $conflict_check == true; $i++){
                    $enrolled_id = $enrolled_arr[$i];
                    $enrollee_sched_check = mysqli_query($db, "SELECT * FROM schedules WHERE id = $enrolled_id");
                    $en_row = mysqli_fetch_assoc($enrollee_sched_check);
                    //get data for each sched from table:schedules
                    $enrolled_day = $en_row['day'];
                    $enrolled_start = $en_row['time_start'];
                    $enrolled_end = $en_row['time_end'];
                    $enrollees = $en_row['enrollees'];
                    if($enrolled_day == $chosen_day && $chosen_start <= $enrolled_start && $chosen_end >= $enrolled_end ||  $chosen_start > $enrolled_start && $chosen_end <= $enrolled_end ){
                        $conflictErr = "Student cannot be enrolled due to schedule conflict.";
                        $studErrors++;
                        $conflict_check == false;
                    }
                }
            }
        }
        if ($studErrors == 0) {
            $update = mysqli_query($db, "UPDATE schedules SET enrollees = $total WHERE id = $sched_id");
            $insert = mysqli_query($db, "INSERT INTO enrollees (stud_id,sched_id) VALUES ($id_num,$sched_id)");
            $total_check_query = mysqli_query($db, "SELECT * FROM enrollees WHERE sched_id = $sched_id");
            $total = mysqli_num_rows($total_check_query);
            $update = mysqli_query($db, "UPDATE schedules SET enrollees = $total WHERE id = $sched_id");
            header('location: AdminHome.php');
        }
    }
}
// ADMIN END

// STUDENT

// View Schedule
if (isset($_POST['view_sched_stud'])) {
    $row_id = $_POST['row_id'];
    $stud_id = $_POST['stud_id'];
    $query = "SELECT * FROM subjects WHERE id = $row_id";
    $result = mysqli_query($db, $query);
    $_SESSION['course'] = mysqli_fetch_assoc($result);
    $query = "SELECT * FROM users WHERE id_num = $stud_id";
    $result = mysqli_query($db, $query);
    $_SESSION['user'] = mysqli_fetch_assoc($result);
    header("Location: ViewScheduleStud.php");
}

//MY SCHEDULE
if (isset($_GET['view_sched'])) {
    $id_num = $_GET['view_sched'];
    $query = "SELECT * FROM enrollees WHERE stud_id = $id_num";
    $result = mysqli_query($db, $query);
    $_SESSION['mysched'] = mysqli_fetch_assoc($result);
}

//DELETE SCHED
if (isset($_GET['del_sched_student'])) {
    $id_num = $_GET['del_sched_student'];
    $query = "SELECT * FROM enrollees WHERE id = $id_num";
    $result = mysqli_query($db, $query);
    $_SESSION['mysched'] = mysqli_fetch_assoc($result);
    $query = "DELETE FROM enrollees WHERE id = $id_num";
    $result = mysqli_query($db, $query);
    $sched_id = $_SESSION['mysched']['sched_id'];
    $query = "SELECT * FROM enrollees WHERE sched_id = $sched_id";
    $result = mysqli_query($db, $query);
    $total = mysqli_num_rows($result);
    $update_enrollees = mysqli_query($db, "UPDATE schedules SET enrollees = $total WHERE id= $sched_id");
}

//ENROLL STUDENT SIDE
$studErrors = 0;
$conflictErr = "";
$conflict_check == true;
$conflictError = "";
$enrolled_arr = array();

if(isset($_POST['enroll_student_side'])){
    $sched_id = $_POST['sched_id'];
    $id_num = $_POST['stud_id'];
    $enrolled_check_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num AND sched_id = $sched_id");
    if (mysqli_num_rows($enrolled_check_result) > 0) {
        $conflictErr = "Oops! You are already enrolled in this schedule.";
        $studErrors++;
    }else {
         $get_course = mysqli_query($db, "SELECT * FROM schedules WHERE id = $sched_id");
         $get_course_row = mysqli_fetch_assoc($get_course);
         $enroll_course_id = $get_course_row['course_id'];
         $enroll_enrollees = $get_course_row['enrollees'];
         $chosen_day = $get_course_row ['day'];
         $chosen_start = $get_course_row ['time_start'];
         $chosen_end = $get_course_row['time_end'];
          $course_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num");
          while($course_rows = mysqli_fetch_assoc($course_result)){
              $scheds = $course_rows['sched_id'];
              $check_course_result = mysqli_query($db, "SELECT * FROM schedules WHERE id = $scheds");
              $sched_row = mysqli_fetch_assoc($check_course_result);
              if($enroll_course_id == $sched_row['course_id']){
                  $course_check = false;
              }
          }
          if($course_check == false){
              $conflictErr = "Oops! You are already enrolled in this course.";
              $studErrors++;
          }else {
            $max_check_result = mysqli_query($db, "SELECT * FROM subjects WHERE id = $enroll_course_id");
            $max = mysqli_fetch_assoc($max_check_result);
            $num_max = $max['max'];
            if($num_max < $enroll_enrollees +1){
               $conflictErr = "Oops! Class is already full.";
                $studErrors++;
            }
            $conflict_check_result = mysqli_query($db, "SELECT * FROM enrollees WHERE stud_id = $id_num");
            while($row = mysqli_fetch_assoc($conflict_check_result)){
                array_push($enrolled_arr, $row['sched_id']);
               
            }
            for($i = 0; $i < count($enrolled_arr); $i++){
                $enrolled_id = $enrolled_arr[$i];
                $enrollee_sched_check = mysqli_query($db, "SELECT * FROM schedules WHERE id = $enrolled_id");
                $en_row = mysqli_fetch_assoc($enrollee_sched_check);
                $enrolled_day = $en_row['day'];
                $enrolled_start = $en_row['time_start'];
                $enrolled_end = $en_row['time_end'];
                if($enrolled_day == $chosen_day && $chosen_start <= $enrolled_start && $chosen_end >= $enrolled_end ||  $chosen_start > $enrolled_start && $chosen_end <= $enrolled_end ){
                   $conflictErr = "Oops! Chosen schedule is in conflict with your existing schedule.";
                    $studErrors++;
                }
            }
        }
    }
    if ($studErrors == 0) {
        $update = mysqli_query($db, "UPDATE schedules SET enrollees = $total WHERE id = $sched_id");
        $insert = mysqli_query($db, "INSERT INTO enrollees (stud_id,sched_id) VALUES ($id_num,$sched_id)");
        $total_check_query = mysqli_query($db, "SELECT * FROM enrollees WHERE sched_id = $sched_id");
        $total = mysqli_num_rows($total_check_query);
        $update = mysqli_query($db, "UPDATE schedules SET enrollees = $total WHERE id = $sched_id");
        $_SESSION['sched'] = mysqli_fetch_assoc($total_check_query);
        // header('location: EnrollStudent_StudentSide.php');
        header('Location: MySchedule.php');
    }
}


// FACULTY
if (isset($_POST['view_students'])) {
    $row_id = $_POST['row_id'];
    $query = "SELECT * FROM enrollees WHERE sched_id = $row_id";
    $result = mysqli_query($db, $query);
    $_SESSION['sched'] = mysqli_fetch_assoc($result);
    $user_id = $_SESSION['sched']['stud_id'];
    $query = "SELECT * FROM users WHERE id_num = $user_id";
    $result = mysqli_query($db, $query);
    header('location: ClassList.php');
}
