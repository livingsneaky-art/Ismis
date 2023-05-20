<?php
use PHPUnit\Framework\TestCase;

class AddTest extends TestCase
{
    protected $db;

    protected function setUp(): void
    {
        // Create a database connection
        $host = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'ismis_db';

        $this->db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function tearDown(): void
    {
        // Close the database connection
        $this->db = null;
    }

    public function test_admin_add_course()
    {
        // Insert a new course into the 'subjects' table
        $courseCode = 'CIS 1308';
        $courseName = 'Database Systems';
        $units = 3;
        $max = 50;

        $query = "INSERT INTO subjects (course_code, course_name, units, max) VALUES (:courseCode, :courseName, :units, :max)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':courseCode', $courseCode);
        $statement->bindParam(':courseName', $courseName);
        $statement->bindParam(':units', $units);
        $statement->bindParam(':max', $max);
        $statement->execute();

        // Check if the course was inserted successfully
        $rowCount = $statement->rowCount();
        $this->assertEquals(1, $rowCount, "Failed to insert a new course.");

        // Verify the inserted course in the database
        $query = "SELECT * FROM subjects WHERE course_code = :courseCode";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':courseCode', $courseCode);
        $statement->execute();

        $course = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($courseCode, $course['course_code']);
        $this->assertEquals($courseName, $course['course_name']);
        $this->assertEquals($units, $course['units']);
        $this->assertEquals($max, $course['max']);
    }

    public function test_admin_add_schedule()
    {
        // Insert a new schedule into the 'schedules' table
        $courseCode = 'CIS 1308';
        $day = 'Monday';
        $startTime = '09:00 AM';
        $endTime = '10:30 AM';
        $room = 'Room 101';

        $query = "INSERT INTO schedules (course_code, day, start_time, end_time, room) VALUES (:courseCode, :day, :startTime, :endTime, :room)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':courseCode', $courseCode);
        $statement->bindParam(':day', $day);
        $statement->bindParam(':startTime', $startTime);
        $statement->bindParam(':endTime', $endTime);
        $statement->bindParam(':room', $room);
        $statement->execute();

        // Check if the schedule was inserted successfully
        $rowCount = $statement->rowCount();
        $this->assertEquals(1, $rowCount, "Failed to insert a new schedule.");

        // Verify the inserted schedule in the database
        $query = "SELECT * FROM schedules WHERE course_code = :courseCode";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':courseCode', $courseCode);
        $statement->execute();

        $schedule = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals($courseCode, $schedule['course_code']);
        $this->assertEquals($day, $schedule['day']);
        $this->assertEquals($startTime, $schedule['start_time']);
        $this->assertEquals($endTime, $schedule['end_time']);
        $this->assertEquals($room, $schedule['room']);
    }
}

?>