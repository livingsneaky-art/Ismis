<?php
use PHPUnit\Framework\TestCase;

class DeleteTest extends TestCase
{
    protected $pdo;

    protected function setUp(): void
    {
        $host = 'localhost';
        $dbname = 'ismis_db';
        $username = 'root';
        $password = '';

        $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function test_student_delete_schedule()
    {
        // Insert the SQL statements here

        // Delete a schedule with ID 52
        $scheduleId = 52;
        $query = "DELETE FROM schedules WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $scheduleId, PDO::PARAM_INT);
        $statement->execute();

        // Assert that the schedule is successfully deleted
        $query = "SELECT COUNT(*) FROM schedules WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $scheduleId, PDO::PARAM_INT);
        $statement->execute();
        $count = $statement->fetchColumn();

        $this->assertEquals(0, $count);
    }

    public function test_admin_delete_course()
    {
        // Insert the SQL statements here

        // Delete a course with ID 52
        $courseId = 52;
        $query = "DELETE FROM subjects WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $courseId, PDO::PARAM_INT);
        $statement->execute();

        // Assert that the course is successfully deleted
        $query = "SELECT COUNT(*) FROM subjects WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $courseId, PDO::PARAM_INT);
        $statement->execute();
        $count = $statement->fetchColumn();

        $this->assertEquals(0, $count);
    }

    public function test_admin_delete_schedule()
    {
        // Insert the SQL statements here

        // Delete a schedule with ID 52
        $scheduleId = 52;
        $query = "DELETE FROM schedules WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $scheduleId, PDO::PARAM_INT);
        $statement->execute();

        // Assert that the schedule is successfully deleted
        $query = "SELECT COUNT(*) FROM schedules WHERE id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':id', $scheduleId, PDO::PARAM_INT);
        $statement->execute();
        $count = $statement->fetchColumn();

        $this->assertEquals(0, $count);
    }
}

?>