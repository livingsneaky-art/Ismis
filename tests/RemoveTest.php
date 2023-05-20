<?php
use PHPUnit\Framework\TestCase;

class RemoveTest extends TestCase
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

    public function test_admin_remove_instructor()
    {
        // Insert a new instructor into the 'users' table
        $instructorName = 'John Doe';
        $instructorId = 12345;

        $query = "INSERT INTO users (name, id) VALUES (:name, :id)";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':name', $instructorName);
        $statement->bindParam(':id', $instructorId);
        $statement->execute();

        // Check if the instructor was inserted successfully
        $rowCount = $statement->rowCount();
        $this->assertEquals(1, $rowCount, "Failed to insert a new instructor.");

        // Remove the instructor from the 'users' table
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $instructorId);
        $statement->execute();

        // Check if the instructor was removed successfully
        $rowCount = $statement->rowCount();
        $this->assertEquals(1, $rowCount, "Failed to remove the instructor.");

        // Verify that the instructor is no longer in the database
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindParam(':id', $instructorId);
        $statement->execute();

        $instructor = $statement->fetch(PDO::FETCH_ASSOC);

        $this->assertFalse($instructor);
    }
}

?>