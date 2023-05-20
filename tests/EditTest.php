<?php 

use PHPUnit\Framework\TestCase;

class EditTest extends TestCase
{
    public function test_admin_edit_course()
    {
        // Create a mock session with the required values
        $_SESSION['course']['id'] = 1;
        $_SESSION['course']['course_code'] = 'CSE101';
        $_SESSION['course']['course_name'] = 'Introduction to Computer Science';
        $_SESSION['course']['max'] = 50;
        $_SESSION['course']['units'] = 3;

        // Capture the output of the PHP script
        ob_start();
        include 'path/to/your/script.php';
        $output = ob_get_contents();
        ob_end_clean();

        // Assert that the output contains the expected HTML elements or text
        $expectedOutput = '<h2 class="p-2 mb-4 text-center text-white">Edit Course</h2>';
        $expectedOutput .= '<input type="hidden" name="subject_id" value="1">';
        $expectedOutput .= '<input type="text" class="form-control" name="course_code" placeholder="Enter course code" value="CSE101">';
        $expectedOutput .= '<input type="text" class="form-control" name="course_name" placeholder="Enter course name" value="Introduction to Computer Science">';
        $expectedOutput .= '<input type="number" class="form-control" name="max" placeholder="Set the maximum capacity" value="50">';
        $expectedOutput .= '<input type="number" class="form-control" name="units" placeholder="Set the number of units" value="3">';
        $expectedOutput .= '<input type="submit" value="Save" class="btn btn-success btn-lg text-white" name="save">';

        $this->assertStringContainsString($expectedOutput, $output);
    }

    public function test_admin_edit_schedule()
    {
        // Create a mock session with the required values
        $_SESSION['sched']['id'] = 1;
        $_SESSION['sched']['course_id'] = 123;
        $_SESSION['sched']['day'] = 'M';
        $_SESSION['sched']['time_start'] = '08:00:00';
        $_SESSION['sched']['time_end'] = '10:00:00';

        // Capture the output of the PHP script
        ob_start();
        include 'path/to/your/script.php';
        $output = ob_get_contents();
        ob_end_clean();

        // Assert that the output contains the expected HTML elements or text
        $expectedOutput = '<h2 class="p-2 mb-4 text-center text-white">Edit Schedule</h2>';
        $expectedOutput .= '<input type="hidden" name="sched_id" value="1">';
        $expectedOutput .= '<input type="hidden" name="course_id" value="123">';
        $expectedOutput .= '<label class="text-white">Day:</label>';
        $expectedOutput .= '<select class="form-control" name="day">';
        $expectedOutput .= '<option value="M">Monday</option>';
        $expectedOutput .= '<option value="T">Tuesday</option>';
        $expectedOutput .= '<option value="W">Wednesday</option>';
        $expectedOutput .= '<option value="TH">Thursday</option>';
        $expectedOutput .= '<option value="F">Friday</option>';
        $expectedOutput .= '</select>';
        $expectedOutput .= '<label class="text-white">Time Start:</label>';
        $expectedOutput .= '<input type="time" class="form-control" name="time_start" value="08:00:00">';
        $expectedOutput .= '<label class="text-white">Time End:</label>';
        $expectedOutput .= '<input type="time" class="form-control" name="time_end" value="10:00:00">';
        $expectedOutput .= '<input type="submit" value="Save" class="btn btn-success btn-lg text-white" name="save">';

        $this->assertStringContainsString($expectedOutput, $output);
    }
}
?>