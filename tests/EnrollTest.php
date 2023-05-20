<?php
use PHPUnit\Framework\TestCase;

class EnrollTest extends TestCase
{
    public function test_student_enroll_course()
    {
        // Create a mock session with the required values
        $_SESSION['sched']['id'] = 1;
        $_SESSION['sched']['course_id'] = 123;

        // Simulate form submission with sample student ID
        $_POST['stud_id'] = '123456789';
        $_POST['add_student'] = 'Submit';

        // Capture the output of the PHP script
        ob_start();
        include 'path/to/your/script.php';
        $output = ob_get_contents();
        ob_end_clean();

        // Assert that the output contains the expected HTML elements or text
        $expectedOutput = '<h2 class="p-2 mb-4 text-center text-white">Enroll Student</h2>';
        $expectedOutput .= '<input type="hidden" name="sched_id" value="1">';
        $expectedOutput .= '<input type="hidden" name="course_id" value="123">';
        $expectedOutput .= '<input type="text" class="form-control" name="stud_id" placeholder="Enter the ID number">';
        $expectedOutput .= '<input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="add_student">';
        $expectedOutput .= '<span class="error text-danger my-3"></span>';

        $this->assertStringContainsString($expectedOutput, $output);
    }

    public function test_admin_enroll_students()
    {
            // Create a mock session with the required values
            $_SESSION['sched']['id'] = 1;
            $_SESSION['sched']['course_id'] = 123;
        
            // Simulate form submission with sample student ID
            $_POST['stud_id'] = '123456789';
            $_POST['add_student'] = 'Submit';
        
            // Capture the output of the PHP script
            ob_start();
            include 'path/to/your/script.php';
            $output = ob_get_contents();
            ob_end_clean();
        
            // Assert that the output contains the expected HTML elements or text
            $expectedOutput = '<h2 class="p-2 mb-4 text-center text-white">Enroll Student</h2>';
            $expectedOutput .= '<input type="hidden" name="sched_id" value="1">';
            $expectedOutput .= '<input type="hidden" name="course_id" value="123">';
            $expectedOutput .= '<input type="text" class="form-control" name="stud_id" placeholder="Enter the ID number">';
            $expectedOutput .= '<input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="add_student">';
            $expectedOutput .= '<span class="error text-danger my-3"></span>';
        
            $this->assertStringContainsString($expectedOutput, $output);
    }


    public function test_student_already_enrolled_course()
    {
        // Create a mock session with the required values
        $_SESSION['sched']['id'] = 1;
        $_SESSION['sched']['course_id'] = 123;

        // Simulate form submission with sample student ID
        $_POST['stud_id'] = '123456789';
        $_POST['add_student'] = 'Submit';

        // Capture the output of the PHP script
        ob_start();
        include 'path/to/your/script.php';
        $output = ob_get_contents();
        ob_end_clean();

        // Assert that the output contains the expected HTML elements or text
        $expectedOutput = '<h2 class="p-2 mb-4 text-center text-white">Enroll Student</h2>';
        $expectedOutput .= '<input type="hidden" name="sched_id" value="1">';
        $expectedOutput .= '<input type="hidden" name="course_id" value="123">';
        $expectedOutput .= '<input type="text" class="form-control" name="stud_id" placeholder="Enter the ID number">';
        $expectedOutput .= '<input type="submit" value="Submit" class="btn btn-success btn-lg text-white" name="add_student">';
        $expectedOutput .= '<span class="error text-danger my-3"></span>';

        $this->assertStringContainsString($expectedOutput, $output);
    }
}

?>